<?php

namespace App\Policies;

use App\Models\NguoiDung;
use App\Models\PhieuXuat;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhieuXuatPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\NguoiDung  $nguoiDung
     * @return mixed
     */
    public function viewAny(NguoiDung $nguoiDung)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\NguoiDung  $nguoiDung
     * @param  \App\Models\PhieuXuat  $phieuXuat
     * @return mixed
     */
    public function view(NguoiDung $nguoiDung, PhieuXuat $phieuXuat)
    {
        return $nguoiDung->can('xem-phieu-xuat');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\NguoiDung  $nguoiDung
     * @return mixed
     */
    public function create(NguoiDung $nguoiDung)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\NguoiDung  $nguoiDung
     * @param  \App\Models\PhieuXuat  $phieuXuat
     * @return mixed
     */
    public function update(NguoiDung $nguoiDung, PhieuXuat $phieuXuat)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\NguoiDung  $nguoiDung
     * @param  \App\Models\PhieuXuat  $phieuXuat
     * @return mixed
     */
    public function delete(NguoiDung $nguoiDung, PhieuXuat $phieuXuat)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\NguoiDung  $nguoiDung
     * @param  \App\Models\PhieuXuat  $phieuXuat
     * @return mixed
     */
    public function restore(NguoiDung $nguoiDung, PhieuXuat $phieuXuat)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\NguoiDung  $nguoiDung
     * @param  \App\Models\PhieuXuat  $phieuXuat
     * @return mixed
     */
    public function forceDelete(NguoiDung $nguoiDung, PhieuXuat $phieuXuat)
    {
        //
    }
}
