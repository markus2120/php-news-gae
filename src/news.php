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
                                "title" => "Netzwelt",
                                "url" => "http://feeds.feedburner.com/netzwelt",
                            ),
                            array(
                                "title" => "Did you know?",
                                "url" => "http://feeds.feedburner.com/enwp/DidYouKnow?format=xml"
                            ),
                            array(
                                "title" => "Engadget",
                                "url" => "https://www.engadget.com/rss.xml"
                            ),
                            array(
                                "title" => "Guardian-US",
                                "url" => "https://www.theguardian.com/email/us/daily/rss"
                            ),
                            array(
                                "title" => "Guardian-UK",
                                "url" => "https://www.theguardian.com/uk/rss"
                            ),
                            array(
                                "title" => "Economist",
                                "url" => "https://www.economist.com/blogs/economist-explains/index.xml"
                            ),
                            array(
                                "title" => "BBC",
                                "url" => "http://feeds.bbci.co.uk/news/world/rss.xml"
                            ),
                            array(
                                "title" => "GigaOM",
                                "url" => "https://gigaom.com/feed/"
                            ),
                            array(
                                "title" => "Android Central",
                                "url" => "https://feeds2.feedburner.com/androidcentral"
                            ),
                            array(
                                "title" => "Bild",
                                "url" => "https://www.bild.de/rss-feeds/rss-16725492,feed=home.bild.html"
                            ),
                            array(
                                "title" => "Golem",
                                "url" => "https://rss.golem.de/rss.php?feed=RSS2.0"
                            ),
                            array(
                                "title" => "Ars",
                                "url" => "http://feeds.arstechnica.com/arstechnica/index"
                            ),
                            array(
                                "title" => "NY Times",
                                "url" => "http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml"
                            ),
                            array(
                                "title" => "Snopes",
                                "url" => "https://www.snopes.com/feed/"
                            ),
                            array(
                                "title" => "SPIEGEL",
                                "url" => "http://www.spiegel.de/schlagzeilen/tops/index.rss"
                            ),
                            array(
                                "title" => "TechCrunch",
                                "url" => "http://feeds.feedburner.com/TechCrunch"
                            ),
                            array(
                                "title" => "The Register",
                                "url" => "https://www.theregister.co.uk/headlines.rss"
                            ),
                            array(
                                "title" => "TNW",
                                "url" => "https://thenextweb.com/feed/"
                            ),
                            array(
                                "title" => "NewYorker",
                                "url" => "https://www.newyorker.com/feed/magazine/rss"
                            ),
                            array(
                                "title" => "Technology Review",
                                "url" => "https://www.technologyreview.com/topnews.rss"
                            ),
                            array(
                                "title" => "Technology Review",
                                "url" => "https://www.technologyreview.com/topnews.rss"
                            ),
                        );
                        function getFeed($url){
                            $rss = simplexml_load_file($url);
                            $count = 0;
                            $html .= '<ul>';
                            foreach($rss->channel->item as$item) {
                                $count++;
                                if($count > 9){
                                    break;
                                }
//                                 $html .= '<br>'.htmlspecialchars($item->description).'<li><a href="'.htmlspecialchars($item->link).'">'.htmlspecialchars($item->title).'</a></li><br>';
                                $html .= '<li><h5><a href="'.htmlspecialchars($item->link).'">'.htmlspecialchars($item->title).'</a></h3></li><br>';
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

