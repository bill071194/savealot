{"filter":false,"title":"admin.blade.php","tooltip":"/savealot/resources/views/admin.blade.php","undoManager":{"mark":6,"position":6,"stack":[[{"start":{"row":28,"column":0},"end":{"row":45,"column":6},"action":"remove","lines":["","\t// Graphs","\tconst ctx = document.getElementById('revenueChart')","\t// eslint-disable-next-line no-unused-vars","\tconst revenueChart = new Chart(ctx, {","\t\ttype: 'line',","\t\tdata: {","\t\t\tlabels: [","                @foreach ($orders->groupBy('date') as $order)","                    \"{{$order->first()->date}}\",","                @endforeach","\t\t\t],","\t\t\tdatasets: [{","\t\t\t\tdata: [","                    @foreach ($orders->groupBy('date') as $order)","                        {{number_format($order->sum('total'),2)}},","                    @endforeach","\t\t\t\t],"],"id":1},{"start":{"row":28,"column":0},"end":{"row":49,"column":20},"action":"insert","lines":["var goBackDays = 7;","","    var today = new Date();","    var daysSorted = [];","    ","    for(var i = 0; i < goBackDays; i++) {","      var newDate = new Date(today.setDate(today.getDate() - 1));","      daysSorted.push(newDate.toISOString().split('T')[0]);","    }","    ","    var days = daysSorted.reverse();","    var chartData = {!! json_encode($chartData) !!};","","\t// Graphs","\tconst ctx = document.getElementById('revenueChart')","\t// eslint-disable-next-line no-unused-vars","\tconst revenueChart = new Chart(ctx, {","\t\ttype: 'line',","\t\tdata: {","\t\t\tlabels: days,","\t\t\tdatasets: [{","\t\t\t\tdata: chartData,"]}],[{"start":{"row":28,"column":0},"end":{"row":28,"column":4},"action":"insert","lines":["    "],"id":2}],[{"start":{"row":28,"column":4},"end":{"row":29,"column":0},"action":"insert","lines":["",""],"id":3},{"start":{"row":29,"column":0},"end":{"row":29,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":53,"column":18},"end":{"row":53,"column":23},"action":"remove","lines":["black"],"id":4},{"start":{"row":53,"column":18},"end":{"row":53,"column":19},"action":"insert","lines":["g"]},{"start":{"row":53,"column":19},"end":{"row":53,"column":20},"action":"insert","lines":["r"]},{"start":{"row":53,"column":20},"end":{"row":53,"column":21},"action":"insert","lines":["e"]},{"start":{"row":53,"column":21},"end":{"row":53,"column":22},"action":"insert","lines":["e"]},{"start":{"row":53,"column":22},"end":{"row":53,"column":23},"action":"insert","lines":["n"]}],[{"start":{"row":55,"column":27},"end":{"row":55,"column":32},"action":"remove","lines":["green"],"id":5},{"start":{"row":55,"column":27},"end":{"row":55,"column":28},"action":"insert","lines":["b"]},{"start":{"row":55,"column":28},"end":{"row":55,"column":29},"action":"insert","lines":["l"]},{"start":{"row":55,"column":29},"end":{"row":55,"column":30},"action":"insert","lines":["a"]},{"start":{"row":55,"column":30},"end":{"row":55,"column":31},"action":"insert","lines":["c"]},{"start":{"row":55,"column":31},"end":{"row":55,"column":32},"action":"insert","lines":["k"]}],[{"start":{"row":55,"column":31},"end":{"row":55,"column":32},"action":"remove","lines":["k"],"id":6},{"start":{"row":55,"column":30},"end":{"row":55,"column":31},"action":"remove","lines":["c"]},{"start":{"row":55,"column":29},"end":{"row":55,"column":30},"action":"remove","lines":["a"]},{"start":{"row":55,"column":28},"end":{"row":55,"column":29},"action":"remove","lines":["l"]},{"start":{"row":55,"column":27},"end":{"row":55,"column":28},"action":"remove","lines":["b"]}],[{"start":{"row":55,"column":27},"end":{"row":55,"column":28},"action":"insert","lines":["w"],"id":7},{"start":{"row":55,"column":28},"end":{"row":55,"column":29},"action":"insert","lines":["h"]},{"start":{"row":55,"column":29},"end":{"row":55,"column":30},"action":"insert","lines":["i"]},{"start":{"row":55,"column":30},"end":{"row":55,"column":31},"action":"insert","lines":["t"]},{"start":{"row":55,"column":31},"end":{"row":55,"column":32},"action":"insert","lines":["e"]}]]},"ace":{"folds":[],"scrolltop":548.3999999999997,"scrollleft":0,"selection":{"start":{"row":55,"column":32},"end":{"row":55,"column":32},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":9,"state":"start","mode":"ace/mode/php_laravel_blade"}},"timestamp":1680743934994,"hash":"3d2c268bc373176633947f8a09e2448887adf06e"}