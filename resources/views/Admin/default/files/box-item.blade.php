@if ($item && $item->count() > 0)
    <div class="{{ (isset($sClassName) ? $sClassName : 'fileDiv') }}"
         onclick="showEditBar('{{ get_file_url($item->path) }}','{{ $iHeight }}','{{ $item->id }}');"
         ondblclick="showImage('{{ get_file_url($item->path) }}','{{ $iHeight }}');"
         data-imgid="{{ $item->id }}">
        <div class="{{ (isset($sImageDivClassName) ? $sImageDivClassName : 'imgDiv') }}">
            <img class="{{ ( isset($sFileImgClass) ? $sFileImgClass : 'fileImg') }} lazy" data-original="{{ get_file_url($item->path) }}">
        </div>
        <p class="fileDescription"><span class="fileMime">{{ File::extension($item->file_name) }}</span>
            {{ pathinfo($item->file_name, PATHINFO_FILENAME) }}</p>
        <p class="fileTime">{{ $item->updated_at->format('d.m.Y H:i') }}</p>
        <p class="fileTime">{{ round($item->file_size/1024, 1) }} KB</p>
    </div>
@endif