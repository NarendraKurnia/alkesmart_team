<?php
namespace App\Http\Controllers\Adminteam;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use Illuminate\Http\Request;
use App\Models\Pegawai_Model;

class MarketingController extends Controller
{
    // Menampilkan daftar customer
    public function index(Request $request)
    {
        $query = CustomerModel::orderBy('id', 'DESC');
        $customers = $query->paginate(10);

        $pegawai_id = session()->get('pegawai_id');
        $pegawai = Pegawai_Model::where('id_pegawai', $pegawai_id)->first();

        $data = [
            'title' => 'Data Pegawai Marketing',
            'customers' => $customers,
            'pegawai'    => $pegawai,
            'content' => 'adminteam/marketing/index'
        ];

        return view('adminteam/layout/wrapper', $data);
    }

    // Halaman tambah customer
public function tambah()
{
    $data = [
        'title' => 'Tambah Data Pegawai Marketing',
        'content' => 'adminteam/marketing/tambah'
    ];
    return view('adminteam/layout/wrapper', $data);
}

// Proses tambah
public function proses_tambah(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed', // gunakan field password_confirmation
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'marketing',
        'status' => 'verify',
        'created_at' => now(),
        'updated_at' => now()
    ];

    CustomerModel::create($data);

    return redirect()->route('marketing')->with('sukses', 'Marketing berhasil ditambahkan');
}


    // Hapus customer
    public function delete($id)
    {
        $customer = new CustomerModel();
        $customer->hapus(['id' => $id]);

        return redirect('adminteam/marketing')->with(['sukses' => 'Marketing berhasil dihapus']);
    }

    // Halaman edit customer
public function edit($id)
{
    $customer = CustomerModel::findOrFail($id);

    $data = [
        'title' => 'Edit Data Pegawai Marketing',
        'customer' => $customer,
        'content' => 'adminteam/marketing/edit'
    ];

    return view('adminteam/layout/wrapper', $data);
}

// Proses update customer
public function proses_edit(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'nullable|min:6|confirmed', // password opsional
        'role' => 'required|in:admin,staff,owner,marketing',
        'status' => 'required|in:active,verify,banned'
    ]);

    $customer = CustomerModel::findOrFail($id);

    $customer->name = $request->name;
    $customer->email = $request->email;
    $customer->role = $request->role;
    $customer->status = $request->status;

    if($request->password) {
        $customer->password = bcrypt($request->password);
    }

    $customer->save();

    return redirect()->route('marketing')->with('sukses', 'Marketing berhasil diperbarui');
}


}
