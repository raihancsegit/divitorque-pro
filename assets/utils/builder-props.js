// jQuery(function ($) {
//     var image =
//         'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTA4MCIgaGVpZ2h0PSI1NDAiIHZpZXdCb3g9IjAgMCAxMDgwIDU0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZmlsbD0iI0VCRUJFQiIgZD0iTTAgMGgxMDgwdjU0MEgweiIvPgogICAgICAgIDxwYXRoIGQ9Ik00NDUuNjQ5IDU0MGgtOTguOTk1TDE0NC42NDkgMzM3Ljk5NSAwIDQ4Mi42NDR2LTk4Ljk5NWwxMTYuMzY1LTExNi4zNjVjMTUuNjItMTUuNjIgNDAuOTQ3LTE1LjYyIDU2LjU2OCAwTDQ0NS42NSA1NDB6IiBmaWxsLW9wYWNpdHk9Ii4xIiBmaWxsPSIjMDAwIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz4KICAgICAgICA8Y2lyY2xlIGZpbGwtb3BhY2l0eT0iLjA1IiBmaWxsPSIjMDAwIiBjeD0iMzMxIiBjeT0iMTQ4IiByPSI3MCIvPgogICAgICAgIDxwYXRoIGQ9Ik0xMDgwIDM3OXYxMTMuMTM3TDcyOC4xNjIgMTQwLjMgMzI4LjQ2MiA1NDBIMjE1LjMyNEw2OTkuODc4IDU1LjQ0NmMxNS42Mi0xNS42MiA0MC45NDgtMTUuNjIgNTYuNTY4IDBMMTA4MCAzNzl6IiBmaWxsLW9wYWNpdHk9Ii4yIiBmaWxsPSIjMDAwIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz4KICAgIDwvZz4KPC9zdmc+Cg==';
//     var is_vb = $('body').hasClass('et-fb');
//     $(window).on('load', function () {
//         is_vb &&
//             window.ETBuilderBackend &&
//             window.ETBuilderBackend.defaults &&
//             (window.ETBuilderBackend.defaults.torq_alert = {
//                 title: 'Congratulations!',
//                 description: `You have a alert notification. <br/> <br/> <span style="text-decoration: underline;"><a href="#">Learn More</a></span>`,
//             }),
//             (window.ETBuilderBackend.defaults.torq_animated_text = {
//                 prefix: 'This is',
//                 suffix: 'plugin.',
//             }),
//             (window.ETBuilderBackend.defaults.torq_business_hours_child = {
//                 day: 'Monday',
//                 time: '9AM',
//             }),
//             (window.ETBuilderBackend.defaults.torq_carousel_child = {
//                 photo: image,
//                 title: 'Awesome Title',
//             }),
//             (window.ETBuilderBackend.defaults.torq_blurb = {
//                 photo: image,
//                 title: 'Awesome Title',
//                 body_text:
//                     'Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings and even apply custom CSS to this text in the module Advanced settings.',
//             }),
//             (window.ETBuilderBackend.defaults.torq_divider = {
//                 title: 'Torq Text Divider',
//             }),
//             (window.ETBuilderBackend.defaults.torq_flip_box = {
//                 front_title: 'Torq Flip Box Front',
//                 front_description:
//                     'Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings and even apply custom CSS to this text in the module Advanced settings.',

//                 back_title: 'Torq Flip Box Back',
//                 back_description:
//                     'Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings and even apply custom CSS to this text in the module Advanced settings.',
//             }),
//             (window.ETBuilderBackend.defaults.torq_heading = {
//                 center_text: 'Torq Heading',
//             }),
//             (window.ETBuilderBackend.defaults.torq_timeline_horizontal_child = {
//                 title: 'Torq Timeline',
//                 icon: '&#xe023;||divi||400',
//                 date_text: '01 Feb 2023',
//                 description:
//                     'Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings and even apply custom CSS to this text in the module Advanced settings.',
//             }),
//             (window.ETBuilderBackend.defaults.torq_hotspot = {
//                 image,
//             }),
//             (window.ETBuilderBackend.defaults.torq_hotspot_child = {
//                 tooltip_title: 'Torq Hotspot',
//                 spot_icon: '&#x4c;||divi||400',
//                 tooltip_description:
//                     'Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings.',
//             }),
//             (window.ETBuilderBackend.defaults.torq_icon_box = {
//                 title: 'Awesome Title',
//                 description:
//                     'Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings.',
//             }),
//             (window.ETBuilderBackend.defaults.torq_img_scroll = {
//                 image,
//             }),
//             (window.ETBuilderBackend.defaults.torq_card = {
//                 photo: image,
//                 title: 'Awesome Title',
//                 description:
//                     'Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings.',
//             }),
//             (window.ETBuilderBackend.defaults.torq_logo_carousel_child = {
//                 logo: image,
//             }),
//             (window.ETBuilderBackend.defaults.torq_logo_list_child = {
//                 logo_url: image,
//             }),
//             (window.ETBuilderBackend.defaults.torq_video_modal = {
//                 video_link: 'https://www.youtube.com/watch?v=zf2ay9YyHEE',
//             }),
//             (window.ETBuilderBackend.defaults.torq_timeline_child = {
//                 title: 'Awesome Title',
//                 description:
//                     'Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings.',
//                 icon: '&#xe023;||divi||400',
//             }),
//             (window.ETBuilderBackend.defaults.torq_testimonial = {
//                 image,
//                 title: 'Web Designer',
//                 name: 'John Doe',
//                 testimonial:
//                     'Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings.',
//             }),
//             (window.ETBuilderBackend.defaults.torq_team = {
//                 photo: image,
//                 job_title: 'Web Designer',
//                 member_name: 'John Doe',
//                 short_bio:
//                     'Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings.',
//             }),
//             (window.ETBuilderBackend.defaults.torq_review_card = {
//                 image,
//                 title: 'Awesome Title',
//                 description:
//                     'Your content goes here. Edit or remove this text inline or in the module Content settings. You can also style every aspect of this content in the module Design settings.',
//             }),
//             (window.ETBuilderBackend.defaults.torq_restro_menu_child = {
//                 price: '$99',
//                 title: 'Italian pasta',
//             });
//     });
// });
