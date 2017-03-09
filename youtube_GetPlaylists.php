<?php
	// Playlists from Channel ID
    $API_KEY = '';
    $CHANNEL_ID = $_GET['channelId'];
    $responseArray = array();
    
    class arrayItem{
        var $title;
        var $description;
        var $tags;
        function __construct($title, $description, $tags){
            $this->title = $title;
            $this->description = $description;
            $this->tags = $tags;
        }
    }
    
    $URL = 'https://www.googleapis.com/youtube/v3/playlists?part=snippet&maxResults=50&channelId='.$CHANNEL_ID.'&key='.$API_KEY;
    $data = json_decode(file_get_contents($URL));
    while(true){
        foreach($data->items as $item){
            array_push($responseArray, new arrayItem($item->snippet->title,$item->snippet->description,$item->snippet->tag));
        }
        if($data->nextPageToken != null){
            $data = json_decode(file_get_contents($URL.'&pageToken='.$data->nextPageToken));
        }else{
            break;
        }
    }
    echo json_encode($responseArray, JSON_FORCE_OBJECT);
?>