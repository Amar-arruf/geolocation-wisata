<?php

namespace App\Filters;

use App\Libraries\Oauth2google;
use App\Models\UserToken;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterLogin implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        //
        $googleClient = new Oauth2google();
        $UserTokenModels = new UserToken();
        $getUserId = null;
        helper('cookie');

        // check user sudah ter authentification
        if (!isset($_COOKIE["access_token"])) {
            return redirect()->to('/login');
        }


        if (isset($_COOKIE["access_token"])) {
            $expire = get_cookie('access_token', true);
            if ($expire < time()) {
                // Cookie sudah kadaluarsa dan perlu di update
                $accessToken = $googleClient->RefreshToken();
                $googleClient->setAccessToken($accessToken);
                // mendapatkan token sebelumnya 
                $getTokenOld = $UserTokenModels->getToken(get_cookie('access_token'));

                if (is_array($getTokenOld)) {
                    // dapatkan userId
                    $getUserId = $getTokenOld[0]["ID_AKUN"];
                    // check login type 
                    if ($getTokenOld[0]["LOGIN_TYPE"] == 'Google') {
                        // update token di database 
                        $updateToken  = $UserTokenModels->updateTokenDB($getUserId, $accessToken["access_token"], $getTokenOld[0]["LOGIN_TYPE"]);
                        setcookie('access_token', $accessToken["access_token"], time() + 3600, "/", '');
                        redirect("Dashboard/dashboard");
                        exit;
                    } else  if ($getTokenOld[0]["LOGIN_TYPE"] == 'Instagram') {
                        // update token di database 
                        $updateToken  = $UserTokenModels->updateTokenDB($getUserId, $accessToken["access_token"], $getTokenOld[0]["LOGIN_TYPE"]);
                        setcookie('access_token', $accessToken["access_token"], time() + 3600, "/", '');
                        redirect("Dashboard/dashboard");
                        exit;
                    } else {
                        // update token di database 
                        $updateToken  = $UserTokenModels->updateTokenDB($getUserId, $accessToken["access_token"], 'Facebook');
                        setcookie('access_token', $accessToken["access_token"], time() + 3600, "/", '');
                        redirect("Dashboard/dashboard");
                        exit;
                    }
                }
            } else {
                // Cookie masih berlaku
                redirect("Dashboard/dashboard");
            }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
