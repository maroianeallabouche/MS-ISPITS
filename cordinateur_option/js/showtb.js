
    var list1 = [];
    var list2 = [];
    var list3 = [];

    var n = 1;
    var x = 0;

    function AddRow() {

        var AddRown = document.getElementById('show');
        var NewRow = AddRown.insertRow(n);
        date1 = document.getElementById('date1').value;
        date2 = document.getElementById('date2').value;
        m1 = document.getElementById('sg1').value;
        p1 = document.getElementById('sg2').value;

        list1[x] ='Le '+ date1 + ' AU ' + date2;
        list2[x] = m1 ;
        list3[x] = p1 ;


        var cel1 = NewRow.insertCell(0);
        var cel2 = NewRow.insertCell(1);
        var cel3 = NewRow.insertCell(2);


        cel1.innerHTML = list1[x];
        cel2.innerHTML = list2[x];
        cel3.innerHTML = list3[x];

        cel1.setAttribute('class', 'td1');
        cel2.setAttribute('class', 'td1');
        cel3.setAttribute('class', 'td1');

        n++;
        x++;
    }

    function remove() {
        // document.getElementById('show').deleteRow(n-1);
        // n--;
        // x--;
        document.getElementById('date1').value = '';
        document.getElementById('date2').value = '';
        document.getElementById('sg1').value = "";
        document.getElementById('sg2').value = "";

    }
    function removel() {
        document.getElementById('show').deleteRow(n-1);
        n--;
        x--;

    }
