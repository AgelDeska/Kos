<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * authentication routines, simply throw an exception
     * or redirect and exit.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(route_to('login'))->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        // 2. Check if user role is 'admin' (case-insensitive)
        $role = strtolower(session()->get('role') ?? '');
        if ($role !== 'admin') {
            // Redirect to penyewa dashboard or show 403
            return redirect()->to(route_to('penyewa_dashboard'))->with('error', 'Akses ditolak. Hanya Admin yang diizinkan.');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}