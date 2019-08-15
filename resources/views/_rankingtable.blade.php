<div class="table-responsive">
    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#-Position</th>
                <th scope="col">Pilot's name</th>
                <th scope="col">Pilot's nickname</th>                                                         
                                                                    
            </tr>
        </thead>
        <tbody>
            @foreach($rankings as $ranking)            
            <tr>
                <th scope="row">{{$ranking["position"]}}</th>
                <td class="buttonstyle"><a onclick="openModalPilotInfo({{$ranking['pilotId']}},'welcome')">{{$ranking["name"]}}</a></td>
                <td>{{$ranking["username"]}}</td>       
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="links-table">
    {{$rankings->onEachSide(1)->links()}}
</div>