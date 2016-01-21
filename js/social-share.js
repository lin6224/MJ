jQuery(document).ready(function($){
        var availableSocialShare = {
            "s-fackbook" : {
                "url" : "https://www.facebook.com/sharer/sharer.php",
                "query" : {
                    //"app_id" : "128741070634666",
                    //"link" : window.location.href,
                    //"display" : "popup",
                    //"redirect_uri" : "https%3A%2F%2Fsimple2kx.local%2Ffacebook_redirect"
					"u" : window.location.href,
                },
                "window":{
                    "height" : 306,
                    "width" : 650,
                    "scrollbars" : true
                }
            },
            "s-twitter" : {
                "url" : "http://twitter.com/share",
                "query" : {
                    "url" : window.location.href,
                    //"text" : "Harlem+Shake+vFinal+%28NODE+Edition%29%3A",
                    "via" : "simple2kx"
                },
                "window" : {
                    "height" : 650,
                    "width" : 1024,
                    "scrollbars" : true
                }
            },
            "s-gplus" : {
                "url" : "https://plus.google.com/share",
                "query" : {
                    "url" : window.location.href,
                    "source" : "simple2kx"
                },
                "window" : {
                    "height" : 620,
                    "width" : 620,
                    "scrollbars" : true
                }
            }
        };
        
        $('.social-share').live('click',function(){
            var $btn = $(this),type;
            for(type in availableSocialShare){
                if($btn.hasClass(type)){
                    var s = $btn.data('share'), q, w, u;
                    s.target = s.target || "TWAU";
                    if(!s.window){
                        s.window =  availableSocialShare[type].window;
                    }
                    if(!s.query){
                        s.query =  availableSocialShare[type].query;
                    }
                    q = [];
                    for(u in availableSocialShare[type].query){
                        if( availableSocialShare[type].query[u] || ("null" === availableSocialShare[type].query[u] && s.query[u]) ){
                            console.log(u);
                            q.push(u +"=" + (s.query[u]?s.query[u]:availableSocialShare[type].query[u])); 
                        }
                    }
                    u = availableSocialShare[type].url+'?'+q.join('&');
                    
                    q = [];
                    for (w in availableSocialShare[type].window) switch (w) {
                        case "width":
                        case "height":
                        case "top":
                        case "left":
                            q.push(w + "=" + (s.window[w]?s.window[w]:availableSocialShare[type].window[w]));
                            break;
                        case "target":
                        case "noreferrer":
                            break;
                        default:
                            q.push(w + "=" + (s.window[w] ? 1 : 0));
                    }
                    w = q.join(",");
                    
                    window.open(u,s.target,w);
                    break;
                }
            }
            return false;
        });
    });