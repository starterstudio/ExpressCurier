
function SendPack()
{
  var jxdata = { };
  document.querySelectorAll('.judet').forEach(function(item)
  {
    jxdata[$(item).attr('name')] = $(item).children('option:selected').val();
  });
  document.querySelectorAll('input').forEach(function(item)
  {
    if ($(item).attr('name') != null)
    {
      if ($(item).attr('type') == 'radio')
      {
        jxdata[$(item).attr('id').split(" ")[0]] = $(item).is(':checked');
      }
      else
      {
        jxdata[$(item).attr('name')] = $(item).val();
      }
    }
    else if ($(item).attr('id') != null)
    {
      jxdata[$(item).attr('id').split(" ")[0]] =  $(item).val();
    }
  });
  jxdata["colet"] = $("a[aria-controls=Colet]").attr('aria-selected');
  jxdata["plic"]  = $("a[aria-controls=Plic]").attr('aria-selected');
  jxdata["c"]     = "DPD";
  $.post('/send', jxdata).done(function(data)
  {
    if (data['error'] != null) 
    { 
      ShowError(data['error']);
    } 
    else
    {
      $("input[name='ffshi']").val(data['x']);
      document.getElementById('ffact').submit();
    }
  });
}

function ShowError(err_element)
{
  var restitle = document.getElementsByClassName('modal-title')[0];
  var tformat = "Whoops.";
  restitle.innerHTML = tformat;
  var res = document.getElementById('fresult');
  var hformat = "<span>" + err_element + "</span>";
  res.innerHTML = hformat;
  $(".modal").modal({
    backdrop: 'static',
    keyboard: false,
    show: true
    });
    $(".modal-dialog").draggable({
    handle: ".modal-header"
  });
}

function ImportAddressInfo(rb)
{
  var type = rb == "import_expeditor" ? "_Expeditor" : "_Destinatar";
  var exname   = $("form input[name='Nume" + type + "']").val();
  $("form input[name='Nume_Bill']").val(exname);
  var exjudet  = $("select[name=Judet" + type + "] :selected").val();
  $("select[name=Judet_Bill] option:selected").removeAttr("selected");
  $('select[name=Judet_Bill] option[value="' + exjudet + '"]').attr('selected', true);
  var exloc    = $("form input[name='Localitate" + type + "']").val();
  $("form input[name='Localitate_Bill']").val(exloc);
  var expcode  = $("form input[name='CodPostal" + type + "']").val();
  $("form input[name='CodPostal_Bill']").val(expcode);
  var exstr    = $("form input[name='Strada" + type + "']").val();
  $("form input[name='Strada_Bill']").val(exstr);
  var exstrnr  = $("form input[name='StradaNr" + type + "']").val();
  $("form input[name='StradaNr_Bill']").val(exstrnr);
  var exbloc   = $("form input[name='Bloc" + type + "']").val();
  $("form input[name='bfbloc']").val(exbloc);
  var exintr   = $("form input[name='Intrare" + type + "']").val();
  $("form input[name='bfentr']").val(exintr);
  var exetaj   = $("form input[name='Etaj" + type + "']").val();
  $("form input[name='bfetaj']").val(exetaj);
  var exapart  = $("form input[name='Apartament" + type + "']").val();
  $("form input[name='bfapart']").val(exapart);
  var extel    = $("form input[name='Telefon" + type + "']").val();
  $("form input[name='Telefon_Bill']").val(extel);
}

var ainput = $("<input>").attr("type", "hidden").attr("name", "a");
var binput = $("<input>").attr("type", "hidden").attr("name", "b");

function CalculateChange()
{
  var gr      = Number(document.getElementById('greutate').value);
  var lu      = Number(document.getElementById('lungime').value);
  var la      = Number(document.getElementById('latime').value);
  var inn     = Number(document.getElementById('inaltime').value);
  var val_dec = Number(document.getElementById('valoare').value);
  //var content = document.getElementById('continut').value;
  //var obs     = document.getElementById('observatii').value;
  var ramburs = document.getElementById('ramburs').value;
  var colet   = $("a[aria-controls=Colet]").attr('aria-selected');
  var plic    = $("a[aria-controls=Plic]").attr('aria-selected');
  var plic_v  = Number(document.getElementById('plic_valoare').value);

  var sdata   = { '_token' : $('meta[name=csrf-token]').attr('content'), 'weight' : gr, 'length' : lu, 'height' : inn, 'width' : la, 'declared_value' : val_dec, 'ramburs_value' : ramburs, 'colet' : colet, 'plic' : plic, 'plic_valoare' : plic_v };
  $.post('/info-reload', sdata)
  .done(function(data)
  {
    if (data['error'] != null)
    {
      ShowError(data['error']);
    }
    else
    {
      $('#greutate').val(data['dpd_greutate']);
      document.getElementById('dpd_price').innerText       = data['dpd_total'];
      document.getElementById('kgparcel').innerText        = data['dpd_greutate'] + " KG";
      document.getElementById('pret_transport').innerText  = data['dpd_transport'];
      document.getElementById('pret_ramburs').innerText    = data['ramburs'];
      document.getElementById('pret_total').innerText      = data['dpd_total'];
      $(ainput).val(data['ax']);
      $(binput).val(data['bx']);
  }
  });
  $("#ffact").append($(ainput));
  $("#ffact").append($(binput));
}

function FormatWHours(input)
{
  var iformat = [ "Lu", "Ma", "Mi", "Jo", "Vi", "Sa", "Du" ];
  var data = input.split('');
  var result = "";
  for (var i = 0; i < data.length; i++)
  {
    if (data[i] == "1")
    {
      result += iformat[i] + ", ";
    }
  }
  return result;
}

function SelectState(control, index, name, retdata)
{
  for (var x = 0; x < retdata.length; x++)
  {
    if (name === retdata[x][1])
    {
      var tp = (retdata[x][0] == "or.") ? "oras" : "sat";
      var tformat = tp + " " + retdata[x][1];
      tformat += " [" + retdata[x][4] + "]";
      tformat += "\x0AJudet " + retdata[x][2];
      tformat += ", regiune " + retdata[x][3] + ",";
      tformat += "\x0AProgram de lucru: " + FormatWHours(retdata[x][5]);
      control.title = tformat;
      var jcontrol = document.querySelectorAll('.judet')[index];
      for (var o = 1; o < jcontrol.options.length; o++)
      {
        if (retdata[x][3].toLowerCase() == jcontrol[o].value.toLowerCase())
        {
          jcontrol[o].selected = true;
        }
      }
      document.querySelectorAll('.postalcode')[index].value = retdata[x][4];
    }
  }
}

function GetSites()
{
  var displayitems = [];
  var retdata = [];
  document.querySelectorAll('.locality').forEach(function(item, i){
    item.addEventListener('input', event => {
    if (item === document.activeElement)
    {
      $.post('/get-localities', { '_token' : $('meta[name=csrf-token]').attr('content'), 'sn' : item.value })
      .fail(function(data)  { console.log("ERROR: "    + data); }) // do something else
      .done(function(data)
      { 
        var result = JSON.parse(data);
        var sites = result['sites'];
        for (var a = 0; a < sites.length; a++)
        {
          displayitems.push(sites[a]['name']);
          retdata.push([sites[a]['type'], sites[a]['name'], sites[a]['municipality'], sites[a]['region'], sites[a]['postCode'], sites[a]['servingDays']]);
        }
        $(item).autocomplete({ 
          source: displayitems,
          select: function(event, ui)
          {
            SelectState(item, i, ui.item.label, retdata);
          }
        });
      });
    }});
  });
}

function GetStates()
{
    var locations = [ 'Alba', 'Arad', 'Arges','Bacau', 'Bihor', 'Bistrita-Nasaud', 'Botosani',
                      'Braila','Brasov','Bucuresti','Buzau','Calarasi',
                      'Caras-Severin','Cluj','Constanta','Covasna',
                      'Dambovita','Dolj','Galati','Giurgiu',
                      'Gorj','Harghita','Hunedoara','Ialomita',
                      'Iasi','Ilfov','Maramures','Mehedinti',
                      'Mures','Neamt','Olt','Prahova',
                      'Salaj','Satu Mare','Sibiu','Suceava',
                      'Teleorman','Timis','Tulcea','Valcea',
                      'Vaslui','Vrancea']

    var loc_fields = document.querySelectorAll('.judet');
    for (var x = 0; x < loc_fields.length; x++)
    {
      for (var i = 0; i < locations.length; i++)
      {
        var option = locations[i];
        var element = document.createElement("option");
        element.textContent = option;
        element.value = option;
        loc_fields[x].appendChild(element);
      }
    }
}