<?php

namespace SocialAuther\Adapter;

class Mailru extends AbstractAdapter
{
    public function __construct($config)
    {
        parent::__construct($config);

        $this->socialFieldsMap = array(
            'socialId'   => 'uid',
            'email'      => 'email',
            'name'       => 'nick',
            'socialPage' => 'link',
            'avatar'     => 'pic_big',
            'birthday'   => 'birthday'
        );

        $this->provider = 'mailru';
    }

    /**
     * Get user sex or null if it is not set
     *
     * @return string|null
     */
    public function getSex()
    {
        $result = null;

        if (isset($this->userInfo['sex'])) {
            $result = $this->userInfo['sex'] == 1 ? 'female' : 'male';
        }

        return $result;
    }

    /**
     * Authenticate and return bool result of authentication
     *
     * @return bool
     */
    public function authenticate()
    {
        $result = false;

        if (isset($_GET['code'])) {
            $params = array(
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code'],
                'redirect_uri'  => $this->redirectUri
            );

            $tokenInfo = $this->post('https://connect.mail.ru/oauth/token', $params);

            if (isset($tokenInfo['access_token'])) {
                $sign = md5("app_id={$this->clientId}method=users.getInfosecure=1session_key={$tokenInfo['access_token']}{$this->clientSecret}");

                $params['method'] = 'users.getInfo';
                $params['secure'] = '1';
                $params['app_id'] = $this->clientId;
                $params['session_key'] = $tokenInfo['access_token'];
                $params['sig'] = $sign;

                $userInfo = $this->get('http://www.appsmail.ru/platform/api', $params);

                if (isset($userInfo[0]['uid'])) {
                    $this->userInfo = array_shift($userInfo);
                    //$_SESSION['FACEBOOK'] = $this->userInfo;
                    $result = true;
                }
            }
        }

        return $result;
    }

    /**
     * Get user email or null if it is not set
     *
     * @return string|null
     */
    public function getEmail()
    {
        $result = null;

        if (isset($this->userInfo[$this->socialFieldsMap['email']])) {
            $result = $this->userInfo[$this->socialFieldsMap['email']];
        }

        return $result;
    }
    /**
     * Prepare params for authentication url
     *
     * @return array
     */
    public function prepareAuthParams()
    {
        return array(
            'auth_url'    => 'https://connect.mail.ru/oauth/authorize',
            'auth_params' => array(
                'client_id'     => $this->clientId,
                'response_type' => 'code',
                'redirect_uri'  => $this->redirectUri
            )
        );
    }
}