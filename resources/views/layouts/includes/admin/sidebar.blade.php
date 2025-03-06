<?php

   $links = [
      [
         'name' => 'Dashboard',
         'icon' => 'fa-solid fa-gauge',
         'route' => route('admin.dashboard'),
        // 'active' => request()->routeIs($link['route']),//pregunta si la ruta actual coincide con la ruta del enlace admin.dashboard
      ],
      [
         'header'=> 'Administrar Página',
      ],
      [
         'name' => 'usuarios',
         'icon' => 'fa-solid fa-users',
         'route' => '',
         
      ],
      [
         'name' => 'Empresa',
         'icon' => 'fa-solid fa-building',
         'route' => '',
         
      ]         
   ];

?>


<aside id="logo-sidebar" 
   class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" 
      :class="{
      'transform-none': open,
      '-translate-x-full':!open,          
      }"
      
   aria-label="Sidebar">
   
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">

         @foreach($links as $link)
            
            <li>
                  @isset($link['header'])
                     <div class=" px-3 py-2 text-xs font-semibold text-gray-500 uppercase">
                        {{ $link['header']  }}
                     </div>                       
                  @else             
            
                     <a href="{{ $link['route'] }}" 
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs($link['route']) ? 'bg-gray-100' : '' }}">
                        <span class="inline-flex w-6 h-6 justify-center items-center">
                        <i class="{{ $link['icon']  }} text-gray-500"></i>
                        </span>
                        <span class="ms-3">
                           {{ $link['name']  }}
                        </span>
                     </a>
                  @endisset
            </li>
          @endforeach
        
      </ul>
   </div>
</aside>