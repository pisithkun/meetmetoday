<!DOCTYPE html>
<!---Coding By CoderGirl | www.codinglabweb.com--->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>MeetMeToday | My Profile</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="/app.css" />
    <script
      src="https://kit.fontawesome.com/776e4f6f1b.js"
      crossorigin="anonymous"
    ></script>
  </head>
  {{$slot}}
    <!-- footer begins -->
    <footer class="pro-footer">
        <p>
          Copyright &copy; {{date('Y')}} <a href="/" class="text-muted">MeetMeToday</a>.
          All rights reserved.
        </p>
      </footer>
    </body>
  </html>
