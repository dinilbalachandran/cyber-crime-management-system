<?php
$p = $_GET["p"];
include 'utilities.php';
$con = getconnection();
mysqli_select_db($con, "cybercrimesystem");
$sql = "select * from tbl_policestation where district_id='" . $p . "'";
$result = mysqli_query($con, $sql);
?>
<label for="police_station">Police Station</label>
<select id="police_station" name="police_station" required>
    <option value="">Select Police Station</option>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        $psid = $row['station_id'];
        $psname = decrypt($row['station_name']);
    ?>
        <option value="<?php print $psid; ?>"><?php print $psname; ?></option>
    <?php
    }
    ?>
</select>
<?php
?>