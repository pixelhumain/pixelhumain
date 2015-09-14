<?php 
class PDFHelper  {
    
   public static function buildTableKeyValue($data){
        $html = '';
        $ct = 0;
        if(count($data['data'])>0){
            foreach( $data['data'] as $d ){
                $linestyle = ($ct%2) ? 'w' : 'g';
                $html .= '<tr class="'.$linestyle.'">';
                $html .= '<td>'.$d[0].'</td>';
                $html .= '<td>'.$d[1].'</td>';
                $html .= '</tr>';
                $ct++;
            }
            
            $html = '<table class="tablePDF">
                    <tbody>'.$html.'</tbody>
                </table>';
        }
        return $html;
    }
    
    public static function buildTableList($data){
        $html = '';
        $ct = 0;
        if(count($data['data'])>0){
            foreach( $data['data'] as $d ){
                $linestyle = ($ct%2) ? 'w' : 'g';
                $html .= '<tr class="'.$linestyle.'">';
                
                for( $ix=0; $ix < count($data['title']); $ix++ ){
                	if(isset($data['style']) && isset($data['style'][$ix]))
	            		$html .= '<td style="'.$data['style'][$ix].'">';
	            	else
	            		$html .= '<td>';
                    $html .= str_replace('-',' ',$d[$ix]).'</td>';// replace '-' by ' ' to avoid empty row value in PDF. Example : "jean-francois" will appear as blank for participant data
                }
                $html .= '</tr>';
                $ct++;
            }
            
            $titleHTML = '<tr class="tableHead">';
            for( $ixo=0; $ixo < count($data['title']); $ixo++ ){
            	if(isset($data['style']) && isset($data['style'][$ixo]))
            		$titleHTML .= '<td style="'.$data['style'][$ixo].'">';
            	else
            		$titleHTML .= '<td>';
                $titleHTML .= CHtml::encode($data['title'][$ixo]).'</td>';
            }
            
            $titleHTML .= '</tr>';
             
            $html = '<table class="tablePDF">
                    <thead>'.$titleHTML.'</thead>
                    <tbody>'.$html.'</tbody>
                </table>';
        }
        return $html;
    }
    
	public static function buildTableRanks($baseAbsoluteHttpUrl,$_marks){
		        		                                       
        $ct = 0;
        $html = '<table class="tablePDF">
                    <tbody>';
        
        // Global rank
        $linestyle = ($ct%2) ? 'w' : 'g';
        $html .= '<tr class="'.$linestyle.'">
          			<td colspan="3" style="text-align:center">'.
        				self::buildRankImgHtml($_marks,$baseAbsoluteHttpUrl, 'globalclass', 'globaltrend','50','50').
        				//'&nbsp;&nbsp;&nbsp;<i>'.$_marks[MeetingMark::MARK_TYPE_GLOBAL]."/".MeetingMark::MARKS_TOP_LIMIT.'</i>'.
        			'</td></tr>';
        $ct++;

        $linestyle = ($ct%2) ? 'w' : 'g';
        $html .= '<tr class="'.$linestyle.'">';

        // Management img
        $html .= '<td style="text-align:center">'.
        			self::buildRankImgHtml($_marks,$baseAbsoluteHttpUrl, 'managementclass', 'managementtrend').    
        		'</td>';
                    
        // Measure img
        $html .= '<td style="text-align:center">'.
        			self::buildRankImgHtml($_marks,$baseAbsoluteHttpUrl, 'measureclass', 'measuretrend').    
        		'</td>';
        			    
        // Implementation img
		$html .= '<td style="text-align:center">'.
        			self::buildRankImgHtml($_marks,$baseAbsoluteHttpUrl, 'implementationclass', 'implementationtrend').    
        		'</td>';
        
        $html .='</tr>';
        $ct++;        
        $linestyle = ($ct%2) ? 'w' : 'g';
        $html .= '<tr class="'.$linestyle.'">';
        
        // Management title
        $html .= '<td>'.
        			Yii::t('marks', 'Management').    
        		'</td>';
        			    
        // Measure title
        $html .= '<td>'.
        			Yii::t('marks', 'Measure').   
        		'</td>';    
        			
        // Implementation title
        $html .= '<td>'.
        			Yii::t('marks', 'Implementation').    
        		'</td>';
        
        $html .='</tr>';
        $ct++;

        /*        
        $linestyle = ($ct%2) ? 'w' : 'g';
        $html .= '<tr class="'.$linestyle.'">';
        
        // Management title
        $html .= '<td style="text-align:center">
        			<i>'.$_marks[MeetingMark::MARK_TYPE_MANAGEMENT]."/".MeetingMark::MARKS_TOP_LIMIT.'</i>'.    
        		'</td>';
        			    
        // Measure title
        $html .= '<td style="text-align:center">
        			<i>'.$_marks[MeetingMark::MARK_TYPE_MEASURE]."/".MeetingMark::MARKS_TOP_LIMIT.'</i>'.   
        		'</td>';    
        			
        // Implementation title
        $html .= '<td style="text-align:center">
        			<i>'.$_marks[MeetingMark::MARK_TYPE_IMPLEMENTATION]."/".MeetingMark::MARKS_TOP_LIMIT.'</i>'.    
        		'</td>';
        
        $html .='</tr>';
        $ct++;  
        */	
             
        $html .= '</tbody>
                </table>';
        
        return $html;
    }
    
    private static function buildRankImgHtml($_marks,$baseAbsoluteHttpUrl,$markclass,$marktrend,$width='41',$height='41')
    {
    	$html = '';
        if(isset($_marks[$markclass])) 
        	$html .= '<img height="'.$height.'" width="'.$width.'" src="'.$baseAbsoluteHttpUrl.'/images/icons/rank/'.$_marks[$markclass].$_marks[$marktrend].'.png'.'"/>';
        else 
        	$html .= Yii::t(PTranslate::CAT_WORDING, 'no Marks yet');    
        
        return $html;
    }
}