<div class="sidebar" id="sidebar">
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">

    </div><!-- #sidebar-shortcuts -->

    <ul class="nav nav-list">

        @foreach($meniu as $item)

            <li>

                @if(empty($item['submeniu']))
                    <a href="{{ $item['url'] }}">
                        <i class="{{ $item['icon'] }}"></i>
                        <span class="menu-text"> {{ $item['title'] }} </span>
                    </a>
                @else
                    <a href="#" class="dropdown-toggle">
                        <i class="{{ $item['icon'] }}"></i>
                        <span class="menu-text"> {{ $item['title'] }} </span>
                    </a>
                    <ul class="submenu" style="display: none;">
                        @foreach($item['submeniu'] as $submeniu)
                            <li>
                                <a href="{{ $submeniu['url'] }}">
                                    <i class="icon-double-angle-right"></i>
                                    {{ $submeniu['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </li>

        @endforeach

    </ul><!-- /.nav-list -->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
    </div>

    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>
