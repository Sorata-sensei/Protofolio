@foreach ($activities as $activity)
    <div class="col-md-3 mb-4">
        <div class="card 
            @if ($activity->tag == 'Penghargaan') badge-award
            @elseif ($activity->tag == 'Kualifikasi') badge-qualification
            @elseif ($activity->tag == 'Seminar') badge-seminar
            @elseif ($activity->tag == 'Workshop') badge-workshop
            @elseif ($activity->tag == 'Pelatihan') badge-training
            @elseif ($activity->tag == 'Konferensi') badge-conference
            @elseif ($activity->tag == 'Wisuda') badge-graduation
            @elseif ($activity->tag == 'Kelulusan') badge-graduation-success
            @elseif ($activity->tag == 'Graduasi') badge-graduation-day
            @elseif ($activity->tag == 'Pekerjaan Baru') badge-new-job
            @elseif ($activity->tag == 'Karir') badge-career
            @elseif ($activity->tag == 'Lowongan Kerja') badge-job-vacancy
            @elseif ($activity->tag == 'Abdimas') badge-community-service
            @elseif ($activity->tag == 'Sertifikat') badge-certificate
            @else
            badge-empty @endif
            card-main position-relative badge-blue"
            data-content="@if ($activity->tag == null) dimuat @else{{ $activity->tag }} @endif">

            <img src="{{ asset('storage/images/' . $activity->image) }}" class="card-img-top" alt="{{ $activity->title }}"
                loading="lazy">
            <div class="card-body">
                <h5 class="card-title">{{ $activity->title }}</h5>
                <p class="card-text text-justify">{!! $activity->short_description !!}</p>
                <p class="text-muted fs-6 date-time">
                    {{ \Carbon\Carbon::parse($activity->date)->translatedFormat('l, d F Y') }}
                    <br>
                    ({{ \Carbon\Carbon::parse($activity->date)->diffForHumans() }})
                </p>
                <div class="d-grid gap-2">
                    <button type="button" class="button-card" data-bs-toggle="modal"
                        data-bs-target="#Modal{{ $activity->id }}">
                        Lihat Selengkapnya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk setiap aktivitas -->
    <div class="modal fade" id="Modal{{ $activity->id }}" tabindex="-1" aria-labelledby="{{ $activity->title }}"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-header-container">
                        <h5 class="text-center text-capitalize pt-2 fw-bold mb-2">
                            {{ $activity->title }}
                        </h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row align-items-start">
                        <div class="col">
                            <div class="img-activity">
                                <img src="{{ asset('storage/images/' . $activity->image) }}"
                                    alt="{{ $activity->title }}" loading="lazy">
                                <p class="text-muted pt-2">
                                    {{ \Carbon\Carbon::parse($activity->date)->translatedFormat('l, d F Y') }}
                                    <br>
                                    {{ \Carbon\Carbon::parse($activity->date)->diffForHumans() }}
                                </p>
                                @if ($activity->link != null)
                                    <a href="{{ $activity->link }}" target="_blank">{{ $activity->type }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="col text-justify">
                            {!! $activity->description !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
