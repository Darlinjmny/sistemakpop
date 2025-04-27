<div style="text-align: left; margin-bottom: 20px;">
   
</div> <img src="assets/are you sure_.jpeg" style="width: 100px; height: 100px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-right: 10px;">
<h1 style="text-align: center; font-family: Arial, sans-serif; color: #333; margin-bottom: 20px;">Grupos de K-pop</h1>

<table id="groups-table" class="table table-striped table-bordered" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
    <thead>
        <tr style="background-color: #f8f9fa; color: #333; font-weight: bold;">
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Nombre</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Fecha de Debut</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Compañía</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groups as $group)
            <tr id="group-{{ $group->id }}" style="border-bottom: 1px solid #ddd;">
                <td style="padding: 12px; border: 1px solid #ddd;">{{ $group->name }}</td>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($group->debut_date)->format('d/m/Y') }}</td>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ $group->company }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
