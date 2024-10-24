<form action="sresult-hotel.php" method="GET" class="search-property-1">
      <div class="row no-gutters">
       <div class="col-lg d-flex">
        <div class="form-group p-4 border-0">
         <label for="#">Destination</label>
         <div class="form-field">
           <div class="icon"><span class="fa fa-search"></span></div>
           <input type="text" name="destination" class="form-control" placeholder="Search place">
         </div>
       </div>
     </div>
     <div class="col-lg d-flex">
      <div class="form-group p-4">
       <label for="#">Check-in date</label>
        <div class="form-field">
          <div class="icon"><span class="fa fa-calendar"></span></div>
          <input type="date" name="checkin_date" class="form-control" placeholder="Check In Date">
        </div>
     </div>
   </div>
   <div class="col-lg d-flex">
    <div class="form-group p-4">
     <label for="#">Check-out date</label>
        <div class="form-field">
          <div class="icon"><span class="fa fa-calendar"></span></div>
          <input type="date" name="checkout_date" class="form-control" placeholder="Check Out Date">
        </div>
   </div>
 </div>
 <div class="col-lg d-flex">
  <div class="form-group p-4">
   <label for="#">Price Limit</label>
   <div class="form-field">
     <div class="select-wrap">
      <div class="icon"><span class="fa fa-chevron-down"></span></div>
      <select name="price_limit" id="price_limit" class="form-control">
              <option value="">Select Price Limit</option>
              <option value="50">RM50</option>
              <option value="100">RM100</option>
              <option value="200">RM200</option>
              <option value="350">RM350</option>
              <option value="500">RM500</option>
      </select>
    </div>
  </div>
</div>
</div>
<div class="col-lg d-flex">
  <div class="form-group d-flex w-100 border-0">
   <div class="form-field w-100 align-items-center d-flex">
    <input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary">
  </div>
</div>
</div>
</div>
</form>