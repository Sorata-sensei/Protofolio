@extends('main.template.index')
@push('css')
    <style>
        header h1 {
            text-align: center;
            font-weight: bold;
            margin-top: 0;
        }

        header p {
            text-align: center;
            margin-bottom: 0;
        }

        .hexa {
            border: 0px;
            float: left;
            text-align: center;
            height: 35px;
            width: 60px;
            font-size: 22px;
            background: #f0f0f0;
            color: #000000;
            position: relative;
            margin-top: 15px;
        }

        .hexa:before {
            content: "";
            position: absolute;
            left: 0;
            width: 0;
            height: 0;
            border-bottom: 15px solid #f0f0f0;
            border-left: 30px solid transparent;
            border-right: 30px solid transparent;
            top: -15px;
        }

        .hexa:after {
            content: "";
            position: absolute;
            left: 0;
            width: 0;
            height: 0;
            border-left: 30px solid transparent;
            border-right: 30px solid transparent;
            border-top: 15px solid #f0f0f0;
            bottom: -15px;
        }

        .timeline {
            position: relative;
            padding: 0;
            width: 100%;
            margin-top: 20px;
            list-style-type: none;
        }

        .timeline:before {
            position: absolute;
            left: 50%;
            top: 0;
            content: ' ';
            display: block;
            width: 2px;
            height: 100%;
            margin-left: -1px;
            background: rgb(213, 213, 213);
            background: -moz-linear-gradient(top, rgba(213, 213, 213, 0) 0%, rgb(213, 213, 213) 8%, rgb(213, 213, 213) 92%, rgba(213, 213, 213, 0) 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(30, 87, 153, 1)), color-stop(100%, rgba(125, 185, 232, 1)));
            background: -webkit-linear-gradient(top, rgba(213, 213, 213, 0) 0%, rgb(213, 213, 213) 8%, rgb(213, 213, 213) 92%, rgba(213, 213, 213, 0) 100%);
            background: -o-linear-gradient(top, rgba(213, 213, 213, 0) 0%, rgb(213, 213, 213) 8%, rgb(213, 213, 213) 92%, rgba(213, 213, 213, 0) 100%);
            background: -ms-linear-gradient(top, rgba(213, 213, 213, 0) 0%, rgb(213, 213, 213) 8%, rgb(213, 213, 213) 92%, rgba(213, 213, 213, 0) 100%);
            background: linear-gradient(to bottom, rgba(213, 213, 213, 0) 0%, rgb(213, 213, 213) 8%, rgb(213, 213, 213) 92%, rgba(213, 213, 213, 0) 100%);
            z-index: 5;
        }

        .timelineli {
            padding: 2em 0;
        }

        .timeline .hexa {
            width: 16px;
            height: 10px;
            position: absolute;
            background: #000000;
            z-index: 5;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            top: -30px;
            margin-top: 0;
        }

        .timeline .hexa:before {
            border-bottom: 4px solid #000000;
            border-left-width: 8px;
            border-right-width: 8px;
            top: -4px;
        }

        .timeline .hexa:after {
            border-left-width: 8px;
            border-right-width: 8px;
            border-top: 4px solid #000000;
            bottom: -4px;
        }

        .direction-l,
        .direction-r {
            float: none;
            width: 100%;
            text-align: center;
        }

        .flag-wrapper {
            text-align: center;
            position: relative;
        }

        .flag {
            position: relative;
            display: inline;
            background: rgb(255, 255, 255);
            font-weight: 600;
            z-index: 15;
            padding: 6px 10px;
            text-align: left;
            border-radius: 5px;
        }

        .direction-l .flag:after,
        .direction-r .flag:after {
            content: "";
            position: absolute;
            left: 50%;
            top: -15px;
            height: 0;
            width: 0;
            margin-left: -8px;
            border: solid transparent;
            border-bottom-color: rgb(255, 255, 255);
            border-width: 8px;
            pointer-events: none;
        }

        .direction-l .flag {
            -webkit-box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
            box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
        }

        .direction-r .flag {
            -webkit-box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
            box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
        }

        .time-wrapper {
            display: block;
            position: relative;
            margin: 4px 0 0 0;
            z-index: 14;
            line-height: 1em;
            vertical-align: middle;
            color: #fff;
        }

        .direction-l .time-wrapper {
            float: none;
        }

        .direction-r .time-wrapper {
            float: none;
        }

        .time {
            background: #000000;
            display: inline-block;
            padding: 8px;
        }

        .desc {
            position: relative;
            margin: 1em 0 0 0;
            padding: 1em;
            background: rgb(254, 254, 254);
            -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.20);
            -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.20);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.20);
            z-index: 15;

        }

        .job-desc {
            font-size: 1em !important;
        }

        .direction-l .desc,
        .direction-r .desc {
            position: relative;
            margin: 1em 1em 0 1em;
            padding: 1em;
            z-index: 15;
            text-align: left;
        }

        .company-logo {
            width: 50px !important;
            height: 50px !important;
            border-radius: 5px;
            margin-right: 15px;
        }

        .experience-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        @media(min-width: 768px) {
            .timeline {
                width: 660px;
                margin: 0 auto;
                margin-top: 20px;
            }

            .timelineli:after {
                content: "";
                display: block;
                height: 0;
                clear: both;
                visibility: hidden;
            }

            .timeline .hexa {
                left: -28px;
                right: auto;
                top: 8px;
            }

            .timeline .direction-l .hexa {
                left: auto;
                right: -28px;
            }

            .direction-l {
                position: relative;
                width: 310px;
                float: left;
                text-align: right;
            }

            .direction-r {
                position: relative;
                width: 310px;
                float: right;
                text-align: left;
            }

            .flag-wrapper {
                display: inline-block;
            }

            .flag {
                font-size: 18px;
            }

            .direction-l .flag:after {
                left: auto;
                right: -16px;
                top: 50%;
                margin-top: -8px;
                border: solid transparent;
                border-left-color: rgb(254, 254, 254);
                border-width: 8px;
            }

            .direction-r .flag:after {
                top: 50%;
                margin-top: -8px;
                border: solid transparent;
                border-right-color: rgb(254, 254, 254);
                border-width: 8px;
                left: -8px;
            }

            .time-wrapper {
                display: inline;
                vertical-align: middle;
                margin: 0;
            }

            .direction-l .time-wrapper {
                float: left;
            }

            .direction-r .time-wrapper {
                float: right;
            }

            .time {
                padding: 5px 10px;
            }

            .direction-r .desc {
                margin: 1em 0 0 0.75em;
            }
        }

        @media(min-width: 992px) {
            .timeline {
                width: 800px;
                margin: 0 auto;
                margin-top: 20px;
            }

            .direction-l {
                position: relative;
                width: 380px;
                float: left;
                text-align: right;
            }

            .direction-r {
                position: relative;
                width: 380px;
                float: right;
                text-align: left;
            }

            .experience-card {
                /* background-color: #fff; */
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                margin-bottom: 20px;
                padding: 20px;
                display: flex;
                flex-direction: column;
            }

            .experience-header {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }



            .job-title h3 {
                font-size: 18px;
                font-weight: bold;
                color: #333;
            }

            .job-title .company-name {
                font-size: 14px;
                color: #777;
            }

            .experience-details {
                margin-top: 15px;
            }


            .skills {
                font-size: 14px;
                color: #555;
            }

            .skill-category {
                font-weight: bold;
                color: #333;
            }

            .more-skills {
                color: #000000;
                margin-left: 5px;
                font-weight: bold;
            }
        }
    </style>
@endpush
@section('content')
    @include('main.header.navbar')

    <div class="container " style="margin-top: 5rem !important;">
        <div class="row">

            <header>
                <h1 class="pt-2">Perjalanan Karier</h1>
                <p style="text-align: center">Halaman ini merangkum <b>perjalanan karier</b> saya, dari awal hingga saat ini.
                    Setiap
                    pengalaman, tantangan, dan pencapaian yang tercatat di sini mencerminkan komitmen saya untuk terus
                    berkembang dan memberikan <b>kontribusi terbaik.</b> </p>
            </header>
            <ul class="timeline">
                @foreach ($cariers as $index => $carier)
                    <li class="timelineli">
                        <div class="{{ $index % 2 == 0 ? 'direction-r' : 'direction-l' }}">
                            <div class="flag-wrapper">
                                <span class="hexa"></span>
                                <span class="flag">{{ $carier->company_name }}</span>
                                <span class="time-wrapper"><span
                                        class="time">{{ \Carbon\Carbon::parse($carier->start_date)->format('M Y') }}</span></span>
                            </div>
                            <div class="desc">
                                <div class="experience-header">
                                    <div>
                                        <!-- Ganti dengan logo perusahaan -->
                                        <img class="company-logo" src="{{ asset('storage/' . $carier->logo) }}"
                                            alt="Company Logo">
                                    </div>
                                    <div class="job-title">
                                        <p style="margin: 0px !important;"><b>{{ $carier->role }}</b></p>
                                        <span class="company-name">{{ $carier->job_status }}</span>
                                    </div>
                                </div>

                                <p class="job-desc">
                                    {!! $carier->description !!}
                                </p>

                                <div class="experience-details">
                                    <div class="skills">
                                        <span class="skill-category">
                                            @if ($carier->skills && count($carier->skills) > 0)
                                                {{ implode(', ', array_slice($carier->skills, 0, 3)) }}
                                            @else
                                                Belum ada skill yang di isi
                                            @endif
                                        </span>

                                        @if ($carier->skills && count($carier->skills) > 2)
                                            <span class="more-skills">+{{ count($carier->skills) - 2 }} keahlian
                                                lainnya</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
