<?
    $domainId = $domain['Domain']['id'];
    $count = count($domain['Activity']);
    $different = count($activitiesSummary);
    $percentual = @(int)($different / $count*100);
?>
<div class="well">
    <h1>
        <i class="<? echo h($domain['Domain']['icon']); ?>"></i>
        Activities Dashboard: <? echo h($domain['Domain']['name']); ?>  
        <span class="pull-right"><? echo $different?> / <? echo $count ?> (<? echo $percentual?>%)</span>
    </h1>
    <span><? echo h($domain['Domain']['description']); ?></span>
    <br/>
    <br/>
    <div class="progress ">
        <div class="progress-bar" role="progressbar" aria-valuenow="<? echo $percentual?>" aria-valuemin="0" aria-valuemax="100" 
        style="background-color: <? echo $domain['Domain']['color']?>; width: <? echo $percentual?>%">
            <span class="sr-only"><? echo $percentual?>% Complete (success)</span>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-table">
    <table class="table table-responsive">
        <tr>
            <th>Completed?</th>
            <th>Activity</th>
            <th style="text-align: right">XP</th>
            <th style="text-align: right">Times Logged</th>
            <th style="text-align: right">Actions</th>
        </tr>
        <?foreach($domain['Activity'] as $activity): ?>
            <?
                $summary = isset($activitiesSummary[$activity['id']])? $activitiesSummary[$activity['id']]['PlayerActivitySummary']: null;
            ?>
            <tr>
                <td>
                    <?if ($summary == null) : ?>
                        <i style="color: red" class="glyphicon glyphicon-remove"></i>
                    <?else:?>
                        <i style="color: green" class="glyphicon glyphicon-ok"></i>
                    <?endif;?>
                </td>
                <td><?=h($activity['name']); ?></td>
                <td style="text-align: right"><?=number_format($activity['xp']); ?></td>
                <td style="text-align: right"><?=number_format($summary == null? 0 : $summary['count']); ?></td>
                <td style="text-align: right"><a class="btn btn-xs btn-info" href="<? echo $this->Html->url('/activities/report/' . $activity['id']); ?>">Report now!</a></td>
            </tr>
        <?endforeach;?>
    </table>
</div>

<a class="btn btn-lg btn-primary" href="<? echo $this->Html->url('/dashboards/activities'); ?>">Back to Activities Dashboards</a>


