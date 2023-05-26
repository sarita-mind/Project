<?php $error = array(); ?>

<?php if(count($error) > 0) :?>
    <div class = "error"> 
        <?php foreach ($error as $e) :?> 
            <p><?php echo $e ?></p>
        <?php endforeach?> 
    </div>

<?php endif ?>


<?php  
    $popular = 'SELECT s.ShowID, ms.ShowName, s.Poster, l.LocationName FROM showinfo s JOIN location l ON s.LocationID = l.LocationID JOIN showtime t ON s.ShowID = t.ShowtimeID WHERE t.ShowDateTime > CURDATE() GROUP BY s.ShowID LIMIT 4';
    $upcoming = 'SELECT * FROM ShowInfo WHERE SaleDate > CURDATE() ORDER BY SaleDate LIMIT 4';
    $query1 =  mysqli_query($con,$popular);
    $query2 = mysqli_query($con,$upcoming);
?>

<?php
        while($row1 = mysqli_fetch_assoc($query1)){
    ?>
    <div class="event">
        <img src="./image/<?php echo $row1['Poster']?>" alt="<?php echo $row1['ShowName']?>">
        <a href="event.php/id=<?=$row1['ShowID']?>"> <p class="event_name"><?php echo $row1['ShowName']?></p></a>
        <p class="location"><?php echo $row1['LocationName']?></p>
        
    </div>

<?php } ?>

