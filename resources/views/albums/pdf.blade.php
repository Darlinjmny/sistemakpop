<div style="text-align: left; margin-bottom: 10px;">
    <img src="assets/are you sure_.jpeg" style="width: 100px; height: 100px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-right: 10px;">
</div>
<h1 style="text-align: center; font-family: Arial, sans-serif; color: #333; margin-bottom: 20px;">Álbumes</h1>

<table id="groups-table" class="table table-striped table-bordered" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
    <thead>
        <tr style="background-color: #f8f9fa; color: #333; font-weight: bold;">
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Titulo</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Fecha de Lanzamiento</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Grupo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($albums as $album)
            <tr id="album-{{ $album->id }}" style="border-bottom: 1px solid #ddd;">
                <td style="padding: 12px; border: 1px solid #ddd;">{{ $album->title }}</td>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ \Illuminate\Support\Carbon::parse($album->release_date)->format('d/m/Y') }}</td>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ $album->group->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
