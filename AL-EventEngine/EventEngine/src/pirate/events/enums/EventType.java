/*
 * This file is part of Aion-Lightning <aion-lightning.org>.
 *
 * Aion-Lightning is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Aion-Lightning is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Aion-Lightning.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * Credits goes to all Open Source Core Developer Groups listed below
 * Please do not change here something, ragarding the developer credits, except the "developed by XXXX".
 * Even if you edit a lot of files in this source, you still have no rights to call it as "your Core".
 * Everybody knows that this Emulator Core was developed by Aion Lightning 
 * @-Aion-Unique-
 * @-Aion-Lightning
 * @Aion-Engine
 * @Aion-Extreme
 * @Aion-NextGen
 * @Aion-Core Dev.
 *
 */
package pirate.events.enums;

import com.aionemu.gameserver.dataholders.DataManager;
import pirate.events.xml.EventTemplate;
import pirate.events.xml.EventsData;

/**
 *
 * @author f14shm4n
 */
public enum EventType {

    E_DEFAULT(false),
    E_1x1(true),
    E_2x2(true),
    E_3x3(true),
    E_4x4(true),
    E_6x6(true),
    E_LHE(true),
    E_TVT(false),
    E_FFA(true);
    //-----------------------------//
    private boolean isDone;

    private EventType(boolean isDone) {
        this.isDone = isDone;
    }

    public boolean IsDone() {
        return isDone;
    }

    public EventTemplate getEventTemplate() {
        return DataManager.F14_EVENTS_DATA.getEventTemplate(this);
    }
}
