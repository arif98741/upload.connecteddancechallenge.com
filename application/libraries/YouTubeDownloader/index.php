<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Youtube Downloader</title>
    <meta name="keywords"
          content="Video downloader, download youtube, video download, youtube video, youtube downloader, download youtube FLV, download youtube MP4, download youtube 3GP, php video downloader"/>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-download {
            max-width: 300px;
            padding: 19px 29px 29px;
            margin: 0 auto 20px;
            background-color: #fff;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        }

        .form-download .form-download-heading,
        .form-download .checkbox {
            margin-bottom: 10px;
            text-align: center;
        }

        .form-download input[type="text"] {
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
        }

        .userscript {
            float: right;
            margin-top: 5px
        }

    </style>
</head>
<body>
	<form class="form-download" method="get" id="download" action="GetVideo.php">
		<h1 class="form-download-heading">Youtube Downloader</h1>
		<input type="text" name="videoid" id="videoid" size="40" placeholder="YouTube Link or VideoID" />
		<input class="btn btn-primary" type="submit" name="type" id="type" value="Download" />
		<p>Valid inputs are YouTube links or VideoIDs:</p>
		<ul>
			<li>youtube.com/watch?v=<b>aBCdEFGhIJk</b></li>
			<li><b>youtube.com/watch?v=...</b></li>
			<li><b>youtu.be/...</b></li>
		</ul>

	<!-- @TODO: Prepend the base URI -->
<?php
include_once('common.php');

if ( \YoutubeDownloader\YoutubeDownloader::is_chrome() and (isset($config['feature']['browserExtensions']) && $config['feature']['browserExtensions'] == true) )
{
	echo '<a href="ytdl.user.js" class="userscript btn btn-mini" title="Install chrome extension to view a \'Download\' link to this application on Youtube video pages."> Install Chrome Extension </a>';
}
?>
</form>
</body>
</html>
