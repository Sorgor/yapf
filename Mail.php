<?php

class yapf_Mail
{

    public function addTarget($email)
    {
        $this->targets[] = $email;
    }

    public function addFile($filePath)
    {
        $this->file = $filePath;
    }

    public function addTheme($theme)
    {
        $this->theme = $theme;
    }

    public function addHtml($html){
        $this->html = $html;
    }

    public function sendMail()
    {
        $headers = '';
        $multipart = '';
        $boundary = '--' . md5(uniqid(time()));


        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\n";
        $multipart .= "--$boundary\n";
        $kod = 'utf-8'; // или $kod = 'windows-1251';
        $multipart .= "Content-Type: text/html; charset=$kod\n";
        $multipart .= "Content-Transfer-Encoding: Quot-Printed\n\n";
        $multipart .= "$this->html\n\n";

        if (isset($this->file)) {
            $fp = fopen($this->file, 'r');
            if ($fp) {
                $fileConents = fread($fp, filesize($this->file));
            }
            fclose($fp);
            $message_part = "--$boundary\n";
            $message_part .= "Content-Type: application/octet-stream\n";
            $message_part .= "Content-Transfer-Encoding: base64\n";
            $message_part .= "Content-Disposition: attachment; filename = \"" . $this->file . "\"\n\n";
            $message_part .= chunk_split(base64_encode($fileConents)) . "\n";
            $multipart .= $message_part . "--$boundary--\n";
        }


        foreach ($this->targets as $target) {
            $result = mail($target, $this->theme, $multipart, $headers);
            if(!$result) return false;
        }
    }
}