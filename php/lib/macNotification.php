<?php
class macNotification
{
    public function notify($content, $title, $subtitle)
    {
        $cmd = <<<EOF
osascript -e 'display notification "{$content}" with title "{$title}" subtitle "{$subtitle}"'
EOF;
        exec($cmd);
    }
    
    public function baseNotify($content, $title)
    {
        $cmd = <<<EOF
osascript -e 'display notification "{$content}" with title "{$title}"'
EOF;
        exec($cmd);
    }
}