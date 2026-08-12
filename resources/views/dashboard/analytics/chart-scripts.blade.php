<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Colour palette ──────────────────────────────────────────────
    var C = {
        blue:   'rgba(52, 144, 220, 0.85)',
        green:  'rgba(39, 174, 96, 0.85)',
        red:    'rgba(192, 57, 43, 0.85)',
        orange: 'rgba(230, 126, 34, 0.85)',
        purple: 'rgba(142, 68, 173, 0.85)',
        teal:   'rgba(26, 188, 156, 0.85)',
        yellow: 'rgba(241, 196, 15, 0.85)',
        pink:   'rgba(231, 76, 60, 0.85)',
    };

    var PIE_COLORS = [
        C.blue, C.green, C.orange, C.purple,
        C.teal, C.yellow, C.pink, C.red,
        'rgba(52,73,94,.85)', 'rgba(22,160,133,.85)',
        'rgba(39,174,96,.85)', 'rgba(41,128,185,.85)',
    ];

    // ── Shared chart options factories ──────────────────────────────
    function barOpts(horizontal) {
        var base = {
            maintainAspectRatio: false,
            legend: { display: false },
            scales: {
                yAxes: [{
                    gridLines: { display: false },
                    ticks: { beginAtZero: true, fontColor: '#aaa' }
                }],
                xAxes: [{
                    gridLines: { color: 'transparent' },
                    ticks: { fontColor: '#aaa' }
                }]
            }
        };
        if (horizontal) {
            // flip axes for horizontal bar
            base.scales.xAxes[0].ticks.beginAtZero = true;
            base.scales.yAxes[0].ticks.beginAtZero = false;
        }
        return base;
    }

    function makeBar(id, labels, data, color, horizontal) {
        var el = document.getElementById(id);
        if (!el || !labels.length) return;
        new Chart(el, {
            type: horizontal ? 'horizontalBar' : 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '',
                    backgroundColor: color || C.blue,
                    borderColor: 'transparent',
                    data: data,
                    barPercentage: 0.6,
                    categoryPercentage: 0.75,
                }]
            },
            options: barOpts(horizontal)
        });
    }

    // ── Issues trend (line chart) ───────────────────────────────────
    (function () {
        var el = document.getElementById('chart-trend');
        if (!el) return;
        new Chart(el, {
            type: 'line',
            data: {
                labels: {!! json_encode($trend['labels']) !!},
                datasets: [
                    {
                        label: 'Raised',
                        data: {!! json_encode($trend['raised']) !!},
                        borderColor: C.red,
                        backgroundColor: 'rgba(192,57,43,0.12)',
                        pointBackgroundColor: C.red,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.35,
                    },
                    {
                        label: 'Closed',
                        data: {!! json_encode($trend['closed']) !!},
                        borderColor: C.green,
                        backgroundColor: 'rgba(39,174,96,0.12)',
                        pointBackgroundColor: C.green,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.35,
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    labels: { fontColor: '#ccc', fontSize: 11 }
                },
                scales: {
                    yAxes: [{
                        gridLines: { color: 'rgba(255,255,255,0.05)' },
                        ticks: { beginAtZero: true, fontColor: '#aaa' }
                    }],
                    xAxes: [{
                        gridLines: { color: 'transparent' },
                        ticks: { fontColor: '#aaa' }
                    }]
                }
            }
        });
    })();

    // ── Most reported equipment (horizontal bar) ────────────────────
    makeBar(
        'chart-equipment',
        {!! json_encode($topEquipment['names']) !!},
        {!! json_encode($topEquipment['counts']) !!},
        C.orange,
        true
    );

    // ── Engineers ───────────────────────────────────────────────────
    makeBar('chart-eng-top',    {!! json_encode($engineers['top_names']) !!},    {!! json_encode($engineers['top_stats']) !!},    C.blue);
    makeBar('chart-eng-bottom', {!! json_encode($engineers['bottom_names']) !!}, {!! json_encode($engineers['bottom_stats']) !!}, C.red);

    // ── Producers ───────────────────────────────────────────────────
    makeBar('chart-prod-top',    {!! json_encode($producers['top_names']) !!},    {!! json_encode($producers['top_stats']) !!},    C.teal);
    makeBar('chart-prod-bottom', {!! json_encode($producers['bottom_names']) !!}, {!! json_encode($producers['bottom_stats']) !!}, C.purple);

    // ── Editors ─────────────────────────────────────────────────────
    makeBar('chart-edit-top',    {!! json_encode($editors['top_names']) !!},    {!! json_encode($editors['top_stats']) !!},    C.green);
    makeBar('chart-edit-bottom', {!! json_encode($editors['bottom_names']) !!}, {!! json_encode($editors['bottom_stats']) !!}, C.yellow);

    // ── OB Logs ─────────────────────────────────────────────────────
    makeBar('chart-ob-top', {!! json_encode($oblogs['top_names']) !!}, {!! json_encode($oblogs['top_stats']) !!}, C.blue);

    // ── Graphics ────────────────────────────────────────────────────
    makeBar('chart-gfx-top',   {!! json_encode($graphics['top_names']) !!},       {!! json_encode($graphics['top_stats']) !!},       C.teal);
    makeBar('chart-gfx-shows', {!! json_encode($graphics['shows_top_names']) !!}, {!! json_encode($graphics['shows_top_stats']) !!}, C.orange);

    // ── Store borrowers ─────────────────────────────────────────────
    makeBar('chart-borrowers', {!! json_encode($borrowers['names']) !!}, {!! json_encode($borrowers['stats']) !!}, C.purple);

    // ── Staff by department (doughnut) ──────────────────────────────
    (function () {
        var el = document.getElementById('chart-departments');
        if (!el) return;
        var deptNames  = {!! json_encode($departments['names']) !!};
        var deptCounts = {!! json_encode($departments['counts']) !!};
        if (!deptNames.length) return;
        new Chart(el, {
            type: 'doughnut',
            data: {
                labels: deptNames,
                datasets: [{
                    data: deptCounts,
                    backgroundColor: PIE_COLORS.slice(0, deptNames.length),
                    borderColor: '#1c1c1c',
                    borderWidth: 2,
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'right',
                    labels: { fontColor: '#ccc', fontSize: 10, boxWidth: 12 }
                }
            }
        });
    })();

});
</script>
