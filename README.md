# media_download_php
A PHP file to download a media file (mp3 or mp4) from another server to your server.

How to use? 

Simply copy media_download.php to your server.

It will create the directory "download" if you have not created it.

It will prompt you to enter the URL of a media file.

This script accepts MP3 and MP4 files, but you can expand the array to include WAV, OGG, etc. 

You can customize the directory name in line 37.

For example, I put mine in a directory called "go", so my downloads would be found in domain.com/go/download/media.mp3. 

So I had to change line 37 to reflect "go/download/" instead of just "download".

Have fun with it.

Credits: Thank you, ChatGPT for helping me with this script.
