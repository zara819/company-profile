<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\MasterHead;
use App\Models\Portofolio;
use App\Models\Service;
use App\Models\Contact;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PublicController extends Controller
{
    public function index() {
        return view('pages.fe.index');
    }

    public function get_Data():JsonResponse
     {
        $masterHead = MasterHead::select('title','subtitle','image')->latest()->first();
        $services = Service::select('title','description','image')->get();
        $porto = Portofolio::select('client','category','image','slug')->get();
        $about = About::select('year','title','description','image')->get();

        $contactNotif = Contact::where('is_read', 0)->count();
    $contactNotifId = Contact::where('is_read', 0)->pluck('id')->first(); // Or return all if needed

        $data = [
            'master_head' => $masterHead,
            'services' => $services,
            'portofolio' => $porto,
            'about' => $about,
            'contact' => $contactNotif, // Count of unread contact messages
        'contact_id' => $contactNotifId, 
        ];
        return response()->json($data);
    }

    public function detail(Request $request):JsonResponse
    {
        $res = [];
        $rescode = 200;
        $slug = $request->query('slug','');
        try {
            $data = Portofolio::select('title','category','image','client','description')->where('slug',$slug)->first();
            if($data){
                $res = ['success'=>1,'data'=>$data];
            } else {
                $res = ['success'=>0,'message'=>'Data Tidak Ditemukan'];
            }
        } catch (QueryException $e){
            $res = ['success'=>0,'message'=>'ops terjadi kesalahan saat mengambil data'];
            Log::error('QueryException: '.$e);
        } catch (Exception $e){
            $res = ['success'=>0,'message'=>'ops terjadi kesalahan pada server'];
            Log::error('Exception: '.$e);
        }
        return response()->json($res,$rescode);
    }

    public function storeMessage(Request $request):JsonResponse
    {
        date_default_timezone_set('Asia/Jakarta');
        
        $rescode = 200;
        $res = [];
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email:dns|max:255',
                'phone' => 'required|string|max:15',
                'message' => 'required|string|max:255',
            
            ];
            $massages = [
    
                'required' => ':attribute wajib diisi',
                'string' => ':attribute harus bertipe string',
                'max' => ':attribute tidak boleh lebih dari :max',
                'email.dns'=> 'domainemail tidak valid',
                'email'=> 'email tidak valid',
                
            ];
            $data = $request->all();
            $validator = Validator::make($data, $rules, $massages);
            if ($validator->fails()) {
                $v_error = $validator->errors()->all();
                // Jika validasi gagal, kembalikan pesan kesalahan
                $res = ['success' => 0, 'messages' => implode(',', $v_error)];
            } else {
                $validData = $validator->validate();
                Contact::create($validData);
                $res = ['success' => 1, 'messages' => 'Success '];
            }
        } catch (QueryException $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan saat Proses data'];
            Log::error('QueryException: '.$e);
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan pada server'];
            Log::error('Exception: '.$e);
        }

        return response()->json($res, $rescode);
    }

    public function markAsRead(Request $request)
    {
        // Update status notifikasi (misalnya, menandai sebagai sudah dibaca di database)
        $unreadMessages = Contact::where('is_read', false)->get();

        foreach ($unreadMessages as $message) {
            $message->update(['is_read' => true]);
        }

        // Mengembalikan response sukses
        return response()->json(['status' => 'success']);
    }

}

