<?php
// YouTube Downloader PHP
// based on youtube-dl in Python http://rg3.github.com/youtube-dl/
// by Ricardo Garcia Gonzalez and others (details at url above)
//
// Takes a VideoID and outputs a list of formats in which the video can be
// downloaded

include_once('common.php');
ob_start();// if not, some servers will show this php warning: header is already set in line 46...

class GetVideo{


    public function downloadLink($videoId){
        /*if( ! isset($_GET['videoid']) )
        {
            echo '<p>No video id passed in</p>';
            exit;
        }*/

//        $my_id = $_GET['videoid'];
        $my_id=$videoId;


        /*if( preg_match('/^(https?:\/\/)?(w{3}\.)?youtube.com\//', $my_id) )
        {
            $url = parse_url($my_id);
            $my_id = null;

            if( is_array($url) && count($url)>0 && isset($url['query']) && !empty($url['query']) )
            {
                $parts = explode('&',$url['query']);

                if( is_array($parts) && count($parts) > 0 )
                {
                    foreach( $parts as $p )
                    {
                        $pattern = '/^v\=/';

                        if( preg_match($pattern, $p) )
                        {
                            $my_id = preg_replace($pattern,'',$p);
                            break;
                        }
                    }
                }

                if( !$my_id )
                {
                    echo '<p>No video id passed in</p>';
                    exit;
                }
            }
            else
            {
                echo '<p>Invalid url</p>';
                exit;
            }
        }
        elseif( preg_match('/^(https?:\/\/)?youtu.be/', $my_id) )
        {
            $url   = parse_url($my_id);
            $my_id = null;
            $my_id = preg_replace('/^(youtu\.be)?\//', '', $url['path']);
        }*/



// end of if for type=Download

        /* First get the video info page for this video id */
//$my_video_info = 'http://www.youtube.com/get_video_info?&video_id='. $my_id;
//video details fix *1
        $my_video_info = 'http://www.youtube.com/get_video_info?&video_id=' . $my_id . '&asv=3&el=detailpage&hl=en_US';
        $my_video_info = \YoutubeDownloader\YoutubeDownloader::curlGet($my_video_info);



//        print_r($my_video_info);


        /* TODO: Check return from curl for status code */

        parse_str($my_video_info, $video_info);

        /*echo '<pre>';
        print_r($video_info);*/

//        echo $video_info['status'];

        /** @var $status */
        if ($video_info['status'] == 'fail')
        {
//            echo '<p>Error in video ID</p>';
            return false;
        }




        /* Now get the url_encoded_fmt_stream_map, and explode on comma */
        $stream_map = \YoutubeDownloader\YoutubeDownloader::createStreamMapFromVideoInfo($video_info);


        /* create an array of available download formats */
        $avail_formats = \YoutubeDownloader\YoutubeDownloader::parseStreamMapToFormats($stream_map[0]);


        /* In this else, the request didn't come from a form but from something else
             * like an RSS feed.
             * As a result, we just want to return the best format, which depends on what
             * the user provided in the url.
             * If they provided "format=best" we just use the largest.
             * If they provided "format=free" we provide the best non-flash version
             * If they provided "format=ipad" we pull the best MP4 version
             *
             * Thanks to the python based youtube-dl for info on the formats
             *   							http://rg3.github.com/youtube-dl/
             */

        $redirect_url = \YoutubeDownloader\YoutubeDownloader::getDownloadUrlByFormats($avail_formats, 'best');

//        echo $redirect_url;
        return $redirect_url;
    }

}

