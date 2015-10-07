<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 02.10.2015
 * Time: 13:22
 */
?>
<style type="text/css">
    #canvas_container {
        width: 500px;
        height: 500px;
        //background-color: #0000C0;
        border: 1px solid #aaa;
    }
</style>
<div id="canvas_container"></div>

<script>
    window.onload = function() {
        var paper = new Raphael(document.getElementById('canvas_container'), 500, 500);
//        var circ = paper.circle(250, 250, 20).attr({fill: '#000'});
//        var mood_text = paper.text(250, 250, 'My\nMood').attr({fill: '#fff'});

        moods = ['Rubbish', 'Not Good', 'OK', 'Smily', 'Positively Manic'];
        colors = ['#cc0000', '#a97e22', '#9f9136', '#7c9a2d', '#3a9a2d'];

        //pick a mood between 1 and 5, 1 being rubbish and 5 being positively manic
        var my_mood = 5;


        for(var i = 0; i < my_mood; i+=1) {
            (function(i) {
                setTimeout(function() {
                    paper.circle(250+(i*15), 250+(i*15), 20).attr({
                        stroke: 'none',
                        fill: colors[my_mood - 1]
                    }).animate({translation: '0 ' + (-42 * (i+1))}, 2000, 'bounce').toBack();
                }, 50*i);
            })(i);
        }
        paper.text(250, 300, moods[my_mood - 1]).attr({fill: colors[my_mood - 1]});

        mood_text.node.onclick = function() {
            return false;
        }
        circ.node.onclick = function() {
            return false;
        }
    }
</script>
