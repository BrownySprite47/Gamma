<?php

namespace SocialAuther\Adapter;

class Facebook extends AbstractAdapter
{
    public function __construct($config)
    {
        parent::__construct($config);

        $this->socialFieldsMap = array(
            'socialId'   => 'id',
            'email'      => 'email',
            'name'       => 'name',
            'socialPage' => 'link',
            'sex'        => 'gender',
            'birthday'   => 'birthday'
        );

        $this->provider = 'facebook';
    }

    /**
     * Get url of user's avatar or null if it is not set
     *
     * @return string|null
     */
    public function getAvatar()
    {
        $result = null;
        if (isset($this->userInfo['id'])) {
            $result = 'http://graph.facebook.com/' . $this->userInfo['id'] . '/picture?type=large';
        }

        return $result;
    }

    /**
     * Get user social id or null if it is not set
     *
     * @return string|null
     */
    public function getSocialPage()
    {
        $result = null;

        if (isset($this->userInfo['id'])) {
            $result = 'http://www.facebook.com/' . $this->userInfo['id'];
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
                'redirect_uri'  => $this->redirectUri,
                'client_secret' => $this->clientSecret,
                'code'          => $_GET['code'],
                'fields'        => 'id,name,email,birthday'
            );

            //parse_str($this->get('https://graph.facebook.com/oauth/access_token', $params, false), $tokenInfo);
            //$tokenInfo = $this->get('https://graph.facebook.com/oauth/access_token', $params, false);
            $tokenInfo = $this->get('https://graph.facebook.com/oauth/access_token', $params);
            if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
                $params['access_token'] = $tokenInfo['access_token'];
                $userInfo = $this->get('https://graph.facebook.com/me', $params);

                if (isset($userInfo['id'])) {
                    $this->userInfo = $userInfo;
                    $result = true;
                    //$_SESSION['FACEBOOK'] = $this->userInfo;
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
            'auth_url'    => 'https://www.facebook.com/dialog/oauth',
            'auth_params' => array(
                'client_id'     => $this->clientId,
                'redirect_uri'  => $this->redirectUri,
                'response_type' => 'code',
                'scope'         => 'public_profile,email'
            )
        );
    }
}