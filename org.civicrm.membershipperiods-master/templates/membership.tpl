{* template block that contains the new field *}
<div id="testfield-tr">
    <table>
        <tr>
            <th>Membership Peroid</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
        {foreach from=$result key=index item=row}
            <tr>
                <td>Period - {$index+1}</td>
                <td>{$row.start_date}</td>
                <td>{$row.end_date}</td>
            </tr>
        {/foreach}
    </table>
</div>
{* reposition the above block *}