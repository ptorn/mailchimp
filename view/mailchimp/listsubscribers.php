<?php

$output = "";

foreach ($data as $subscriber) {
    $output .= "<tr>";
    $output .= "<td>" . $subscriber->email_address . "</td>";
    $output .= "<td>" . $subscriber->merge_fields->FNAME . "</td>";
    $output .= "<td>" . $subscriber->merge_fields->LNAME . "</td>";
    $output .= "</tr>";
}
?>


<h1>Subscribers to <?= $defaultListId ?></h1>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Email</th>
            <th>Firstname</th>
            <th>LastName</th>
        </tr>
    </thead>
    <tbody>
        <?= $output ?>
    </tbody>
</table>
