</p>
2
 
3
 function login(){
4
 session_start();
5
 $this->lib_include();
6
 $api = new Google_Client();
7
 $api->setApplicationName("InfoTuts");
8
 $api->setClientId('##########################################');
9
 $api->setClientSecret('#######################################');
10
 $api->setAccessType('online');
11
 $api->setScopes(array('https://www.googleapis.com/auth/plus.login', 'https://www.googleapis.com/auth/plus.me', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile'));
12
 $api->setRedirectUri('http://www.infotuts.com/demo/googlelogin/login.php');
13
 $service = new Google_PlusService($api);
14
 $oauth2 = new Google_Oauth2Service($api);
15
 $api->authenticate();
16
 $_SESSION['token'] = $api->getAccessToken();
17
 if (isset($_SESSION['token'])) {
18
 $set_asess_token = $api->setAccessToken($_SESSION['token']);
19
 }
20
 if ($api->getAccessToken()) {
21
 $data = $service->people->get('me');
22
 $user_data = $oauth2->userinfo->get(); ?>
23
<p style="text-align: justify;">
