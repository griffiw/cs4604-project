<?php
  $title = " | Home";
  include("header.php");
?>
<h1>CS 4604 Project Assignment #3</h1>

<h2>Relations:</h2>
<i>
  In the following, substitute actual names for Relation1, Relation2
  etc. Have entries for five relations in your project, ideally
  representing different aspects of the database.
  Clicking a link on a relation name should execute an SQL query and list
  10-20 tuples in that particular relation (of course, they don't work
  below). Your output should be presented on a separate web page in a neat
  orderly fashion, one row for each tuple and where columns are evident. 
  Ensure that all columns have their headers listed and their types are
  clear (i.e., state which is an int and which is a char and so
  on).
</i>
<br><br>
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
<i>
  In the following, substitute the english query description for a
  query to your database. You can use a query from Project Assignment 2 of
  the project, if you like, <strong>as long as the query does not take more than 10
  seconds to execute</strong>. This constraint is to prevent overloading the database
  with expensive queries that run for minutes or hours. You can use the
  <code>LIMIT</code> keyword to list a small number of tuples, say 10-20,
  that satisfy the query. Again, clicking a
  link on the query name should execute the appropriate SQL query and list
  the tuples that are the answer to that particular query. Make sure your
  output is neatly ordered and column names and types are evident. The
  output should appear on a separate page.
</i>
<br><br>
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
<i>
  Here, provide a free-form box and two buttons called
  "Submit" and "Clear". The intent is that the user can enter any arbitrary
  SQL query in the box and click the submit button; The action should be that you should
  execute that query on the database and bring up the answers on a separate
  page, once again, in a neat orderly fashion. Notice that the input
  can be any legal SQL query (permissible under your DB system, of course).
</i>
<br><br>
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
