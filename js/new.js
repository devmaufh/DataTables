document.addEventListener('DOMContentLoaded', function () {
    var options = {
        defaultDate: new Date().setHours(0,0,0),
        setDefaultDate: false
    };
    var elems = document.querySelector('.datepicker');
    var instance = M.Datepicker.init(elems, options);
    // instance.open();
    instance.setDate(new Date(2018, 2, 8));
});

document.addEventListener('DOMContentLoaded', function() {
    var options={  
    }
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });
  document.addEventListener('DOMContentLoaded', function() {
    var options={
        
    }
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, options);
  });