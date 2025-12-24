<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Wisata;
class WisataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['showAll', 'showOne']]);
    }
    public function showAll(Request $request)
    {
        $query = Wisata::query();

        // Filtering
        if ($request->has('nama_wisata') && !empty($request->nama_wisata)) {
            $query->where('nama_wisata', 'like', '%' . $request->nama_wisata . '%');
        }
        if ($request->has('lokasi') && !empty($request->lokasi)) {
            $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
        }
        if ($request->has('kategori') && !empty($request->kategori)) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->has('harga_min') && is_numeric($request->harga_min)) {
            $query->where('harga_tiket', '>=', $request->harga_min);
        }
        if ($request->has('harga_max') && is_numeric($request->harga_max)) {
            $query->where('harga_tiket', '<=', $request->harga_max);
        }
        if ($request->has('rating_min') && is_numeric($request->rating_min)) {
            $query->where('rating', '>=', $request->rating_min);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'asc');
        
        // Validasi kolom yang boleh di-sort
        $allowedSortColumns = ['id', 'nama_wisata', 'lokasi', 'kategori', 'harga_tiket', 'rating', 'created_at'];
        if (in_array($sortBy, $allowedSortColumns)) {
            $query->orderBy($sortBy, in_array(strtolower($sortOrder), ['asc', 'desc']) ? $sortOrder : 'asc');
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        return response()->json($query->paginate($perPage));
    }
    public function showOne($id)
    {
        return response()->json(Wisata::find($id));
    }
    public function create(Request $request)
    {
        $Wisata = Wisata::create($request->all());
        return response()->json($Wisata, 201);
    }
    public function update($id, Request $request)
    {
        $Wisata = Wisata::findOrFail($id);
        $Wisata->update($request->all());
        return response()->json($Wisata, 200);
    }
    public function delete($id)
    {
        Wisata::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}