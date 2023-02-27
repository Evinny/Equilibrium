<!DOCTYPE html>
<html lang="en">
<head>


    

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <link rel="stylesheet" href="{{URL::asset('../css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('../css/fonts.css')}}">
    <link rel="stylesheet" href="{{URL::asset('../css/style.css')}}">


    


</head>
<body>
    
    <a href='{{route('dashboard.index')}}'>
    <img src='/images\equilibrium_photos\images\dashboard\arrow-pointing-to-left.png' alt='arrow' width="30" height="18" style="margin:1%;"><br>
    </a>
    <hr>
<br><br>
    <form method="post" autocomplete="off" action="{{route('dashboard.input.insert')}}">
    <center>
    @csrf
    
    
    
    <div style="height: 50px;width: 50%;">

    <p align=left>Dia:*
        <span>
            <input style='float:right;width: 65%;height:50px;border-style: ridge; border-radius: 5px; border-width: 1px;padding: 10px;'
                    name="data" id="data" type="datetime-local" value="{{$date}}"> 
        </span>
    </p>

    </div>

    <br>

    <div style="height: 50px;width: 50%;">

        <p align=left>Habito:*
            <span>
                <input style='float:right;width: 65%;height:50px;border-style: ridge; border-radius: 5px; border-width: 1px' 
                    list='habits' name="habit"> 

                        <datalist id='habits'>

                            @foreach($habits as $habit)
                                <option value="{{$habit->name}}">{{$habit->category}}</option>
                            @endforeach

            </span>
        </p>
    </div>

    <br>

    <div style="height: 50px;width: 50%;">
        <p align=left>Estou me Sentindo:*
            <span>
                <input style='float:right;width: 65%;height:50px;border-style: ridge; border-radius: 5px; border-width: 1px' 
                    list='emotions' name="emotion">

                        <datalist id='emotions'>

                            @foreach($emotions as $feeling)
                                <option value="{{$feeling->emotion}}">
                            @endforeach

             </span>
        </p>
        </div>



        



        <div style="height: 10%; 
        width:100%;
        position: absolute;
        bottom: 0;  "><hr style='border-style: ridge;'>
        <div style="height: 99%;width: 50%;">
            <h4 align=left style='line-height: 230%;
            text-align: center;'><span style="padding: 1% 10%"><a href="{{route('dashboard.index')}}">Cancelar</a></span><span style="padding: 1% 10%;color:rgb(61, 147, 216)"><button type='sumbit' >Salvar</button></span></h4>

        </div> 
</body>
</html>