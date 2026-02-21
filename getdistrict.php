<?php
$s = $_GET["s"];
include 'utilities.php';
$con = getconnection();
mysqli_select_db($con, "cybercrimesystem");
$sql = "select * from tbl_district where state_id='" . $s . "'";
$result = mysqli_query($con, $sql);
?>
<label for="district">District</label>
<select id="district" name="district" required>
    <option value="" selected="selected">Select District</option>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        $did = $row['district_id'];
        $dname = decrypt($row['district_name']);
    ?>
        <option value="<?php print $did; ?>"><?php print $dname; ?></option>
    <?php
    }
    ?>
</select>
<?php
?>