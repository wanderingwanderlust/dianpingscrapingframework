<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Scrape Listings</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<div class="container-fluid">

<h1>List of Critics for Le Bordelais</h1>

<div class="col-lg-12">
<table class="table table-bordered">
  <tr>
    <th>Date</th>
    <th>Grade</th>
    <th>Author ID</th>
    <th>Comment Body</th>
    <th>Venue ID</th>
    <th>Source</th>
    <th>User Profile</th>
  </tr>
  @foreach ($critics as $critic)
<tr>
  <td>{{ $critic->date }}</td>
  <td>{{ $critic->original_grade }} | {{$critic->liked}}</td>
  <td>{{ $critic->author_id }}</td>
  <td>{{ $critic->body }}</td>
  <td>{{ $critic->venue }}</td>
  <td>{{ $critic->source_id }}</td>
  <td>{{ $critic->comment_url }}</td>
</tr>
@endforeach
</table>
</div>

</div>







<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
