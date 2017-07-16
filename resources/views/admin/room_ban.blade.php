<div id="collapseBanRoom" class="panel-collapse collapse">                     
    <div class="panel-body"> 
    	<div class="row">
            <div class="col-md-12">
                <table id="banTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User signalé</th>
                            <th>User demandeur</th>
                            <th>Room</th>
                            <th>Motif</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td class="report-id">{{ $report->id }}</td>
                            <td>{{ $report->user_reported->first_name }} {{ $report->user_reported->last_name }}</td>
                            <td>{{ $report->user_asker->first_name }} {{ $report->user_asker->last_name }}</td>
                            <td>{{ $report->room->name }} ({{ $report->room->id }})</td>
                            <td>{{ $report->reason }}</td>
                            <td>{{ date('m/d/Y H:i:s', strtotime($report->date_created)) }}</td>
                            <td id="report-status">
                            	@if($report->status == 0)
	                                <i class="fa fa-check valide-ban-user-room" aria-hidden="true" id="{{ $report->id }}"></i>
	                                <i class="fa fa-times refuse-ban-user-room" aria-hidden="true" id="{{ $report->id }}"></i>
                            	@elseif($report->status == 1)
	                                <p class="text-success">Bannissement validé</p>
                                @else
                                	<p class="text-danger">Bannissement refusé</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>        
                </table>
            </div>
        </div>
    </div>
</div>