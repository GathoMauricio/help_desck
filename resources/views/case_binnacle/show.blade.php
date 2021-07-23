<!-- Modal -->
<div  wire:ignore.self class="modal" id="modal_show_case_binnacles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Bitácoras del caso</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class ="modal-body">
                @if(\Auth::user()->user_rol_id == 1 || \Auth::user()->user_rol_id == 2)
                <p>
                    <button onclick ="createCaseBinnacle();" class="btn btn-primary float-right">
                        <span class="fa fa-plus">&nbsp;&nbsp;</span>
                        Crear bitácora
                    </button>
                </p>
                <br /><br />
                @endif
                @if(!is_null($binnacles))
                    @if(count($binnacles) > 0)
                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline collapsed" role="grid" aria-describedby="example2_info">
                            <thead>
                                <tr>
                                    <th>Autor</th>
                                    <th>Descripción</th>
                                    <th>Fecha</th>
                                    <th colspan="4"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($binnacles as $binnacle)
                                <tr>
                                    <td>{{ $binnacle->author['name'] }} {{ $binnacle->author['middle_name'] }} {{ $binnacle->author['last_name'] }}</td>
                                    <td>{{ $binnacle['description'] }}</td>
                                    <td>{{ formatDate($binnacle['created_at']) }}</td>
                                    <td><span onclick="viewBinnacleImages({{ $binnacle->id }},{{ count(\App\Models\BinnacleImage::where('binnacle_id',$binnacle->id)->get()) }})" class="fa fa-eye text-primary" style="cursor: pointer;"> {{ count(\App\Models\BinnacleImage::where('binnacle_id',$binnacle->id)->get()) }}</span></td>
                                    @if(\Auth::user()->user_rol_id == 1 || \Auth::user()->user_rol_id == 2)
                                    <td><span wire:click="createBinnacleImage({{ $binnacle->id }})" class="fa fa-upload text-info" style="cursor: pointer;"></span></td>
                                    <td><span wire:click="editBinnacle({{ $binnacle->id }})" class="fa fa-edit text-warning" style="cursor: pointer;"></span></td>
                                    @endif
                                    <td>
                                    @if(\Auth::user()->user_rol_id == 1)
                                    <span onclick="destroyBinnacle({{ $binnacle->id }});" class="fa fa-trash text-danger" style="cursor: pointer;"></span>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </body>
                    </table> 
                    @else
                    <h3 class="text-center">No hay información para mostrar</h3>
                    @endif
                @endif
            </div>
            <div class ="modal-footer">

            </div>
        </div>
    </div>
</div>