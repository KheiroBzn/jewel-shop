<div>
    <table class="bg-white " align='center' border='0' cellpadding='0' cellspacing='0' style='height:842px; width:595px;font-size:12px;'>
        <tr>
            <td valign='top'>
                <table width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='bottom' width='50%' height='50'>
                            <div class=""><h4 class="font-weight-bold badge-secondary p-3 text-center">Jewel-Shop</h4></div>
                            <br />
                        </td>
    
                        <td width='50%'>&nbsp;</td>
                    </tr>
                </table>Destinataire: <br /><br />
                <table width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='top' width='40%' style='font-size:12px;'> <strong>[{{ $client->nom }} {{ $client->prenom }}]</strong><br />
                            [{{ $client->adresse }}]
    
                        </td>
                        <td valign='top' width='20%'>
                        </td>
                        <td valign='top' width='40%' style='font-size:12px;'>Date de facturation: {{ $invoice->created_at->format('Y-m-d | H:i'); }}<br />
    
    
                        </td>
    
                    </tr>
                </table>
                <table width='100%' height='100' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td>
                            <div align='center' style='font-size: 14px;font-weight: bold;'>Référence de Facture : {{ $invoice->reference }} </div>
                        </td>
                    </tr>
                </table>
                <table width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
                    <tr>
    
                        <td width='35%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Produit
                            </strong></td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Quantité</strong></td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Prix</strong></td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Sous-Total</strong></td>
    
                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                    
                    @php
                        $cpt = 0;
                    @endphp
    
                    @foreach ($orderDetails as $product)
                        <tr>
    
                            <td valign='top' style='font-size:12px;'>{{ $product->nom }}</td>
                            <td valign='top' style='font-size:12px;'>{{ $product->qte }}</td>
                            <td valign='top' style='font-size:12px;'>{{ number_format($product->prix_unitaire, 2) }} DA</td>
                            <td valign='top' style='font-size:12px;'>{{ number_format($product->sous_total, 2) }} DA</td>
        
                        </tr>
                        @php $cpt++; @endphp                            
                    @endforeach       
                    
                    @while ( $cpt < 15 )
                        <tr>
        
                            <td valign='top' style='font-size:12px;'>&nbsp;</td>
                            <td valign='top' style='font-size:12px;'>&nbsp;</td>
                            <td valign='top' style='font-size:12px;'>&nbsp;</td>
                            <td valign='top' style='font-size:12px;'>&nbsp;</td>
        
                        </tr>
                        @php $cpt++; @endphp    
                    @endwhile
                    
            </td>
        </tr>
    </table>
    <table width='100%' cellspacing='0' cellpadding='2' border='0'>
        <tr>
            <td style='font-size:12px;width:50%;'><strong> </strong></td>
            <td>
                <table width='100%' cellspacing='0' cellpadding='2' border='0'>
                    <tr>
                        <td align='right' style='font-size:12px;'>Total HT</td>
                        <td align='right' style='font-size:12px;'>{{ number_format($invoice->montant_HT, 2) }} DA
                        <td>
                    </tr>
                    <tr>
                        <td align='right' style='font-size:12px;'>Taxes (TVA: 19%)</td>
                        <td align='right' style='font-size:12px;'>{{ number_format($invoice->montant_TVA, 2) }} DA
                        <td>
                    </tr>
                    <tr>
    
                        <td align='right' style='font-size:12px;'><b>Total TTC</b></td>
                        <td align='right' style='font-size:12px;'><b>{{ number_format($invoice->montant_TTC, 2) }} DA</b></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width='100%' cellspacing='0' cellpadding='2'>
        <tr>
            <td width='33%' style='border-top:double medium #CCCCCC;font-size:12px;' valign='top'><b>[Jewel-Shop]</b><br />
               <br />
    
            </td>
            <td width='33%' style='border-top:double medium #CCCCCC; font-size:12px;' align='center' valign='top'>
                [Tlemcen | Algérie] <br />
                Tél: [043 00 00 00]<br />
            </td>
    
            <td valign='top' width='34%' style='border-top:double medium #CCCCCC;font-size:12px;' align='right'>
                [XXXX-XXXX-XXXX]<br />
            </td>
        </tr>
    </table>
    </td>
    </tr>
    </table>
</div>
