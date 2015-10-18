function get_livemon() {
    var nocache = new Date().getTime();
    $.ajax({
        type: "GET",
        url: "/ajax.php?nocache="+nocache+"&action=live",
        cache: false,
        success: function(html1) {
            
            // $out = ''.$resarray[0].'|'.$resarray[1].'|'.$resarray[2].'|'.$apt_updates.'|'.$load1.'|'.$load5.'|'.$load15.'|'.$procs.'|'.$procs_running.'|'.$procs_sleeping.'
            // |'.$procs_zombies.'|'.$total_ram.'|'.$used_ram.'|'.$total_swap.'|'.$used_swap.'|'.$diskread.'|'.$diskwrite.'|'.$netin.'|'.$netout.'|'.$sleeps.'|'.$queries.'|'.$qps.'
            // |'.$slowqueries.'|'.$usage.'|'.$apps1.'|'.$apps2.'';

            var vars = html1.split('|');
            
            $('#distribution').html(vars[0]);
            $('#kernel').html(vars[1]);
            $('#uptime').html(vars[2]);
            
            $('#updates').html(vars[3]);
            $('#load1').html(vars[4]);
            $('#load5').html(vars[5]);
            $('#load15').html(vars[6]);
            $('#procs').html(vars[7]);
            $('#procsrunning').html(vars[8]);
            $('#procssleeping').html(vars[9]);
            $('#procszombies').html(vars[10]);
            $('#totalram').html(vars[11]);
            $('#usedram').html(vars[12]);
            $('#totalswap').html(vars[13]);
            $('#usedswap').html(vars[14]);
            $('#diskread').html(vars[15]);
            $('#diskwrite').html(vars[16]);
            $('#netin').html(vars[17]);
            $('#netout').html(vars[18]);
            $('#sleeps').html(vars[19]);
            $('#queries').html(vars[20]);
            $('#qps').html(vars[21]);
            $('#slowqueries').html(vars[22]);
            $('#usage').html(vars[23]);
            $('#apps1').html(vars[24]);
            $('#apps2').html(vars[25]);
            $('#systin').html(vars[26]);
            $('#cputin').html(vars[27]);
            $('#auxtin').html(vars[28]);
            
        }
    }).done(function(){
        setTimeout(function(){get_livemon();}, 2000);
    });
}

function get_procs() {
    var nocache = new Date().getTime();
    $.ajax({
        type: "GET",
        url: "/ajax.php?nocache="+nocache+"&action=procs",
        cache: false,
        success: function(html2) {
            $('#terminal2').html(html2);
        }
    }).done(function(){
        setTimeout(function(){get_procs();}, 2000);
    });
}

