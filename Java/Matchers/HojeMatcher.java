package br.ce.wcaquino.matchers;

import br.ce.wcaquino.utils.DataUtils;
import org.hamcrest.Description;
import org.hamcrest.TypeSafeMatcher;

import java.util.Calendar;
import java.util.Date;
import java.util.Locale;

public class HojeMatcher extends TypeSafeMatcher<Date> {

    private Integer dias;

    public HojeMatcher(Integer dias){
        this.dias = dias;
    }

    @Override
    protected boolean matchesSafely(Date date) {
        return DataUtils.isMesmaData(date, DataUtils.adicionarDias(new Date(), dias));
    }

    @Override
    public void describeTo(Description description) {
        Calendar data = Calendar.getInstance();
        String dataExtenso = data.getDisplayName(Calendar.DATE, Calendar.LONG, new Locale("pt", "BR"));
        description.appendText(dataExtenso);
    }
}
