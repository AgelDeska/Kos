<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class Peta extends BaseController
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $data['title'] = 'Kelola Peta Lokasi Kos';
        $data['latitude'] = $this->settingModel->getSetting('kos_latitude') ?? '-6.2088';
        $data['longitude'] = $this->settingModel->getSetting('kos_longitude') ?? '106.8456';
        $data['address'] = $this->settingModel->getSetting('kos_address') ?? 'Jakarta, Indonesia';

        return view('admin/peta/index', $data);
    }

    public function update()
    {
        $rules = [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'address' => 'required|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->settingModel->setSetting('kos_latitude', $this->request->getPost('latitude'));
        $this->settingModel->setSetting('kos_longitude', $this->request->getPost('longitude'));
        $this->settingModel->setSetting('kos_address', $this->request->getPost('address'));

        session()->setFlashdata('success', 'Lokasi kos berhasil diperbarui.');
        return redirect()->to(route_to('admin_peta_index'));
    }
}