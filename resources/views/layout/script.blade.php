<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
<script src="{{asset('')}}vendors/js/bootstrap.bundle.min.js"></script>

<script>

    // alert close
    $(".alert").delay(10000).slideUp(500, function () {
        $(this).alert('close');
    });
    

</script>