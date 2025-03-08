<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php
    // Check if ACF plugin is active
    if (function_exists('get_field')) {
        // Get the value of the abwesenheitsnews button group
        $abwesenheitsnews = get_field('abwesenheitsnews', 'option');

        // Get the news content
        $news_content = get_field('news', 'option');

        // Check if news should be displayed (abwesenheitsnews set to "anzeigen" and news content exists)
        if ($abwesenheitsnews === 'anzeigen' && !empty($news_content)) {
    ?>
            <div class="top-header" style="background-color: #000000; color: #ffffff; padding: 10px 0;">
                <div class="container">
                    <div class="top-header-content">
                        <?php echo wp_kses_post($news_content); ?>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'classic-theme'); ?></a>

        <header id="masthead" class="bg-red-400 flex flex-column">
            <div class="container">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) :
                        the_custom_logo();
                    else :
                    ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                        <?php
                        $classic_theme_description = get_bloginfo('description', 'display');
                        if ($classic_theme_description || is_customize_preview()) :
                        ?>
                            <p class="site-description"><?php echo $classic_theme_description; ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div><!-- .site-branding -->
<div class="relative isolate overflow-hidden bg-gray-900 py-24 sm:py-32">
  <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=focalpoint&fp-y=.8&w=2830&h=1500&q=80&blend=111827&sat=-100&exp=15&blend-mode=multiply" alt="" class="absolute inset-0 -z-10 size-full object-cover object-right md:object-center">
  <div class="hidden sm:absolute sm:-top-10 sm:right-1/2 sm:-z-10 sm:mr-10 sm:block sm:transform-gpu sm:blur-3xl" aria-hidden="true">
    <div class="aspect-1097/845 w-[68.5625rem] bg-linear-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
  </div>
  <div class="absolute -top-52 left-1/2 -z-10 -translate-x-1/2 transform-gpu blur-3xl sm:top-[-28rem] sm:ml-16 sm:translate-x-0 sm:transform-gpu" aria-hidden="true">
    <div class="aspect-1097/845 w-[68.5625rem] bg-linear-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
  </div>
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl lg:mx-0">
      <h2 class="text-5xl font-semibold tracking-tight text-white sm:text-7xl">Work with us</h2>
      <p class="mt-8 text-lg font-medium text-pretty text-gray-300 sm:text-xl/8">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat.</p>
    </div>
    <div class="mx-auto mt-10 max-w-2xl lg:mx-0 lg:max-w-none">
      <div class="grid grid-cols-1 gap-x-8 gap-y-6 text-base/7 font-semibold text-white sm:grid-cols-2 md:flex lg:gap-x-10">
        <a href="#">Open roles <span aria-hidden="true">&rarr;</span></a>
        <a href="#">Internship program <span aria-hidden="true">&rarr;</span></a>
        <a href="#">Our values <span aria-hidden="true">&rarr;</span></a>
        <a href="#">Meet our leadership <span aria-hidden="true">&rarr;</span></a>
      </div>
      <dl class="mt-16 grid grid-cols-1 gap-8 sm:mt-20 sm:grid-cols-2 lg:grid-cols-4">
        <div class="flex flex-col-reverse gap-1">
          <dt class="text-base/7 text-gray-300">Offices worldwide</dt>
          <dd class="text-4xl font-semibold tracking-tight text-white">12</dd>
        </div>
        <div class="flex flex-col-reverse gap-1">
          <dt class="text-base/7 text-gray-300">Full-time colleagues</dt>
          <dd class="text-4xl font-semibold tracking-tight text-white">300+</dd>
        </div>
        <div class="flex flex-col-reverse gap-1">
          <dt class="text-base/7 text-gray-300">Hours per week</dt>
          <dd class="text-4xl font-semibold tracking-tight text-white">40</dd>
        </div>
        <div class="flex flex-col-reverse gap-1">
          <dt class="text-base/7 text-gray-300">Paid time off</dt>
          <dd class="text-4xl font-semibold tracking-tight text-white">Unlimited</dd>
        </div>
      </dl>
    </div>
  </div>
</div>

            </div><!-- .container -->
            <div class="w-full divide-y divide-gray-500 overflow-hidden rounded-sm border border-gray-500 bg-gray-200/40 text-gray-800 dark:divide-gray-500 dark:border-gray-500 dark:bg-gray-800/50 dark:text-gray-300">
    <div x-data="{ isExpanded: false }">
        <button id="controlsAccordionItemOne" type="button" class="flex w-full items-center justify-between gap-4 bg-gray-200 p-4 text-left underline-offset-2 hover:bg-gray-200/75 focus-visible:bg-gray-200/75 focus-visible:underline focus-visible:outline-hidden dark:bg-gray-800 dark:hover:bg-gray-800/75 dark:focus-visible:bg-gray-800/75" aria-controls="accordionItemOne" x-on:click="isExpanded = ! isExpanded" x-bind:class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold'  : 'text-onSurface dark:text-onSurfaceDark font-medium'" x-bind:aria-expanded="isExpanded ? 'true' : 'false'">
            What browsers are supported?
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" x-bind:class="isExpanded  ?  'rotate-180'  :  ''">
               <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
        </button>
        <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region" aria-labelledby="controlsAccordionItemOne" x-collapse>
            <div class="p-4 text-sm sm:text-base text-pretty">
                Our website is optimized for the latest versions of Chrome, Firefox, Safari, and Edge. Check our <a href="#" class="underline underline-offset-2 text-sky-900 dark:text-sky-400">documentation</a> for additional information.
            </div>
        </div>
    </div>
    <div x-data="{ isExpanded: false }">
        <button id="controlsAccordionItemTwo" type="button" class="flex w-full items-center justify-between gap-4 bg-gray-200 p-4 text-left underline-offset-2 hover:bg-gray-200/75 focus-visible:bg-gray-200/75 focus-visible:underline focus-visible:outline-hidden dark:bg-gray-800 dark:hover:bg-gray-800/75 dark:focus-visible:bg-gray-800/75" aria-controls="accordionItemTwo" x-on:click="isExpanded = ! isExpanded" x-bind:class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold'  : 'text-onSurface dark:text-onSurfaceDark font-medium'" x-bind:aria-expanded="isExpanded ? 'true' : 'false'">
            How can I contact customer support?
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" x-bind:class="isExpanded  ?  'rotate-180'  :  ''">
               <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
        </button>
        <div x-cloak x-show="isExpanded" id="accordionItemTwo" role="region" aria-labelledby="controlsAccordionItemTwo" x-collapse>
            <div class="p-4 text-sm sm:text-base text-pretty">
                Reach out to our dedicated support team via email at <a href="#" class="underline underline-offset-2 text-sky-900 dark:text-sky-400">support@example.com</a> or call our toll-free number at 1-800-123-4567 during business hours.
            </div>
        </div>
    </div>
    <div x-data="{ isExpanded: false }">
        <button id="controlsAccordionItemThree" type="button" class="flex w-full items-center justify-between gap-4 bg-gray-200 p-4 text-left underline-offset-2 hover:bg-gray-200/75 focus-visible:bg-gray-200/75 focus-visible:underline focus-visible:outline-hidden dark:bg-gray-800 dark:hover:bg-gray-800/75 dark:focus-visible:bg-gray-800/75" aria-controls="accordionItemThree" x-on:click="isExpanded = ! isExpanded" x-bind:class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold'  : 'text-onSurface dark:text-onSurfaceDark font-medium'" x-bind:aria-expanded="isExpanded ? 'true' : 'false'">
            What is the refund policy?
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true" x-bind:class="isExpanded  ?  'rotate-180'  :  ''">
               <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
        </button>
        <div x-cloak x-show="isExpanded" id="accordionItemThree" role="region" aria-labelledby="controlsAccordionItemThree" x-collapse>
            <div class="p-4 text-sm sm:text-base text-pretty">
                Please refer to our <a href="#" class="underline underline-offset-2 text-sky-900 dark:text-sky-400">refund policy page</a> on the website for detailed information regarding eligibility, timeframes, and the process for requesting a refund.
            </div>
        </div>
    </div>
</div>

        </header><!-- #masthead -->

        <div id="content" class="site-content">