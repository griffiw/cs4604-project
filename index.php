<?php
  $title = " | Home";
  include("header.php");
?>
<h1>CS 4604 Project Assignment #3</h1>

<h2>Relations:</h2>
<br>
<ol>
  <li>
    <a href="relation.php?title=relation1" title = "relation1">Relation 1</a> - See 20 sample entries from the "actin" table...
  </li>
  <li>
    <a href="relation.php?title=relation2" title = "relation2">Relation 2</a> - See 20 sample entries from the "director" table...
  </li>
  <li>
    <a href="relation.php?title=relation3" title = "relation3">Relation 3</a> - See 20 sample entries from the "movieinfo" table...
  </li>
  <li>
    <a href="relation.php?title=relation4" title = "relation4">Relation 4</a> - See 20 sample entries from the "performer" table...
  </li>
  <li>
    <a href="relation.php?title=relation5" title = "relation5">Relation 5</a> - See 20 sample entries from the "userinfo" table...
  </li>
</ol>
<br>
<hr>

<h2>Default Queries:</h2>
<br>
<ol>
  <li>
    <a href="query.php?title=query1">Query 1</a> - List the ten lastest videos that the actor "Brad Pitt" has starred.
  </li>
  <li>
    <a href="query.php?title=query2">Query 2</a> - List the first name, last name, and number of friends of the user who has the most friends.
  </li>
  <li>
    <a href="query.php?title=query3">Query 3</a> - List the first and last names of the top 20 users who have submitted the most ratings as well has the number of ratings they have submitted.
  </li>
  <li>
    <a href="query.php?title=query4">Query 4</a> - List the top 20 performers who have acted in the most movies.
  </li>
  <li>
    <a href="query.php?title=query5">Query 5</a> - List the top 20 performers who have acted in the most movies from 1990 - 2000.
  </li>
</ol>
<br>
<hr>
<h2>Ad-hoc Query:</h2>
<br>
<form class="form-inline" method=post action="adhoc.php">
  <div class="form-group">
    <label for="query">
      <strong>Please enter your query here:</strong>
    </label>
    &nbsp;
    <input class="form-control" type=text name="query" id="query">
    &nbsp;
    <input class="btn btn-primary" type=reset value="clear">
    <input class="btn btn-primary" type=submit value="submit">
  </div>
</form>
<br>

</ul>

<?php
  include("footer.php");
?>
