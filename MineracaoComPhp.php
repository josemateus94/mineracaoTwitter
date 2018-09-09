<?php
require_once('TwitterAPIExchange.php');
class MineracaoComPhp{
    
    public static function pesquisa(){
        
        $settings = array(
            'oauth_access_token' => "968521944944529408-oI5NcJVaZellwrsPjhsQkQPDeAZJzKf",
            'oauth_access_token_secret' => "hc7bTI65fG97smD3ZEB6iCjLrBzHBxn2Sp6TIaX8fZSJZ",
            'consumer_key' => "IMJh4kjQLGDzUaT9t1v0RXm5Y",
            'consumer_secret' => "cjt9d684CpvElXof1BxUMgSakNnFBVLDweQTSpGZolzzrnU8JE"
        );
        $url = 'https://api.twitter.com/1.1/followers/ids.json';
        $getfield = '?screen_name=bolsonaros';
        $requestMethod = 'GET';
        
        $twitter = new TwitterAPIExchange($settings);
        echo $twitter;        
    }    
}

?>