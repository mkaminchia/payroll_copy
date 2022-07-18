<?php 
    $session = session();

    $this->extend('/templates/admin_template');

    $this->section('content');
 
?>

    <script>
        var c = document.getElementById("financials");
        c.className += " active";
    </script>

    <div class="welcome-div">
        <h1>EDIT BENEFIT</h1>
    </div>

    <div class="primary-cta">
        <a href="/admin/financials/benefits">Go back</a>
        <a href="/admin">Return to dashboard</a>
    </div>

    <div class="form">
        <form method="post" action="/admin/financials/benefits/processeditbenefit">
            <div class="form-item-group">
                <label for="benefit_ID">Benefit ID:</label>
                <input type="text" name="benefit_ID" id="benefit_ID" value="<?= $_SESSION["benefit"]["benefit_ID"]?> (This field cannot be edited)" readonly>
            </div>
            <div class="form-item-group">
                <label for="benefit_name">Benefit Name:</label>
                <input type="text" name="benefit_name" id="benefit_name" placeholder="<?= $_SESSION["benefit"]["benefit_name"]?>" value="<?= $_SESSION["benefit"]["benefit_name"]?>">
            </div>
            <div class="form-item-group">
                <label for="relief_percentage">Relief Percentage:</label>
                <input type="text" name="relief_percentage" id="relief_percentage" placeholder="<?= $_SESSION["benefit"]["relief_percentage"]?>" value="<?= $_SESSION["benefit"]["relief_percentage"]?>">
            </div>
            <button class="submit-btn" type="submit">Edit</button>
        </form>
    </div>

    
    
<?php $this->endSection(); ?>