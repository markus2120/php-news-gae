<?php
                    function getContent() {
                        //Thanks to https://davidwalsh.name/php-cache-function for cache idea
                        $file = "./feed-cache.txt";
                        $current_time = time();
                        $expire_time = 10 * 60;
                        $file_time = filemtime($file);

                        if(file_exists($file) && ($current_time - $expire_time < $file_time)) {
                            return file_get_contents($file);
                        }
                        else {
                            $content = getFreshContent();
                            file_put_contents($file, $content);
                            return $content;
                        }
                    }

                    function getFreshContent() {
                        $html = '<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lite</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


  </head>

  <body><div class="container">';
          
                        $newsSource = array(
                            array(
                                "title" => "Wired",
                                "url" => "https://www.wired.com/feed/rss"
                            ),
                        );
                        function getFeed($url){
                            $rss = simplexml_load_file($url);
                            $count = 0;
                            $html .= '<ul>';
                            foreach($rss->entry as $value) {
                                if($count > 9){
                                    break;
                                }
//                              $html .= '<br>'.htmlspecialchars($item->description).'<li><a href="'.htmlspecialchars($item->link).'">'.htmlspecialchars($item->title).'</a></li><br>';
//                              $html .= '<li><a href="'.htmlspecialchars($rss->entry[$count]->link->attributes()->href).'">'.htmlspecialchars($rss->entry[$count]->title).'</a></li><br>';
                                $html .= '<li>'.$rss->entry[$count]->title.'</li><br>';
                                $count++;
                            }
                            $html .= '</ul>';
                            return $html;
                        }

                        foreach($newsSource as $source) {
                            $html .= '<h2>'.$source["title"].'</h2>';
                            $html .= getFeed($source["url"]);
                        }
                        return $html;
                    }

                    print getContent();

